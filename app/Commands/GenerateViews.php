<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class GenerateViews extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'generate:views';
    protected $description = 'Génère automatiquement les vues CRUD avec validation JS dynamique.';

    public function run(array $params)
    {
        if (empty($params)) {
            CLI::error("❌ Veuillez spécifier le nom de l'entité.");
            return;
        }

        $entityName = ucfirst($params[0]);
        $modelName = "App\\Models\\" . $entityName . "Model";
        $folderPath = "../app/Views/{$entityName}";

        // Vérifier si l'entité existe
        if (!file_exists("../app/Entities/$entityName.php")) {
            CLI::error("❌ L'entité '$entityName' n'existe pas.");
            return;
        }

        // Vérifier si le modèle existe
        if (!class_exists($modelName)) {
            CLI::error("❌ Le modèle '$modelName' n'existe pas.");
            return;
        }

        // Instancier dynamiquement le modèle
        $model = new $modelName();
        $db = Database::connect();
        $table = $model->table;
        $fields = $db->getFieldData($table);

        if (!$fields) {
            CLI::error("❌ Impossible de récupérer les champs de la table '$table'.");
            return;
        }

        // Créer le dossier des vues s'il n'existe pas
        if (!is_dir($folderPath)) {
            mkdir($folderPath, 0777, true);
        }

        // Générer les fichiers de vues
        file_put_contents("$folderPath/index.php", $this->generateIndexView($entityName, $fields));
        file_put_contents("$folderPath/show.php", $this->generateShowView($entityName, $fields));
        file_put_contents("$folderPath/create.php", $this->generateFormView($entityName, $fields, 'create'));
        file_put_contents("$folderPath/edit.php", $this->generateFormView($entityName, $fields, 'edit'));

        CLI::write("✅ Vues générées dans : app/Views/$entityName", 'green');
    }

    private function generateIndexView($entityName, $fields)
    {
        $columns = implode("\n                    ", array_map(fn($f) => "<th>$f->name</th>", $fields));
        $rows = implode("\n                    ", array_map(fn($f) => "<td><?= \$item->{$f->name} ?></td>", $fields));

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>Liste des {$entityName}s</h2>
<a href="<?= site_url('$entityName/create') ?>" class="btn btn-success">Ajouter</a>

<!--
<form method="get" action="<?= site_url('$entityName') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= isset(\$search) ?  esc(\$search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>
		<?php if (!empty(\$search)) : ?>
			<a href="<?= site_url('$entityName') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>
-->

<table class="table table-striped table-bordered mt-3">
    <thead>
        <tr>
            $columns
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach (\$items as \$item): ?>
			<tr>
				$rows
				<td>
					<a href="<?= site_url('$entityName/show/'.\$item->id) ?>" class="btn btn-info">Voir</a>
				</td>
			</tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Liens de pagination -->
<?php if (\$pager->getPageCount() > 1) { ?>
	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?= \$pager->getCurrentPage() != 1 ? '' : 'disabled' ?>"><a class="page-link" href="<?= \$pager->getPreviousPageURI() ?>">Précédent</a></li>
			<?php
				\$count = \$pager->getPageCount();
				\$cur = \$pager->getCurrentPage();
				\$nb_page = 1;
				\$v1 = \$cur - \$nb_page;
				\$v2 = \$cur + \$nb_page;

				if (\$v1 < 1) {
					\$v1 = 1;
				}

				if (\$v2 > \$count) {
					\$v2 = \$count;
				}

				for (\$value = \$v1 ; \$value <= \$v2; \$value++ ) {
					echo '<li '.(\$cur == \$value ? 'class="active"' : 'class="page-item"' ).'><a class="page-link" href="'.\$pager->getPageURI(\$value).'">'.\$value.'</a></li>';
				}
				?>

			<li class="page-item <?= \$pager->hasMore() ? '' : 'disabled' ?>"><a class="page-link" href="<?= \$pager->getNextPageURI() ?>">Suivant</a></li>
		  </ul>
	</nav>
<?php } ?>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateShowView($entityName, $fields)
    {
        $details = implode("\n        ", array_map(fn($f) => "<tr>\n			<td>$f->name</td>\n			<td><?= \$item->{$f->name} ?></td>\n		</tr>\n", $fields));
		$bouton = '';
		foreach ($fields as $field) {
            if ($field->name == 'actif')
            {
				$bouton = '<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">'. "\n		"
				         .'<button type="submit" class="btn <?= $item->actif ? \'btn-danger\' : \'btn-success\' ?>"> '
				         .'<?= $item->actif ? \'Rendre inactif\' : \'Rendre actif\' ?></button>';
			}
		}

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<div class="container mt-5">
<h2>Détails de {$entityName}</h2>

<table class="table table-striped table-bordered">
	<tbody>
		$details
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('$entityName/update/'.\$item->id) ?>">
		<a href="<?= site_url('$entityName') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('$entityName/edit/'.\$item->id) ?>" class="btn btn-warning">Modifier</a>
		$bouton
	</form>
</div>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateFormView($entityName, $fields, $type)
    {
        $action = $type === 'create' ? "'$entityName/store/'" : "'$entityName/update/'.\$item->id";
        $inputs = "";
        $validationJS = "";
        $row = 0;
        $onsubmit = '';
        $startfunction = '';
        foreach ($fields as $field) {
            if ($field->name == 'id') continue; // Ignore la clé primaire

            // Détecter le type de champ
            $inputType = match (true) {
                str_contains($field->type, 'int') => 'number',
                str_contains($field->type, 'varchar') => 'text',
                str_contains($field->type, 'date') => 'date',
                default => 'text'
            };

            // Génération des inputs HTML

            $inputs .= "\n	<label>{$field->name}</label>\n".
					   "	<input type='$inputType' onchange='setUpper(document.getElementById('$field->name'));' id='$field->name' name='$field->name' value='<?= isset(\$item) ? \$item->$field->name : '' ?>' class='form-control' required>\n";

            if ($type != 'create') {
				$inputs .= "	<input type='hidden' id='old{$field->name}' name='old{$field->name}' value='<?= isset(\$item) ? \$item->$field->name : '' ?>'>\n";

				$validationJS .= "		let $field->name = document.getElementById('$field->name').value;\n".
								 "		let old{$field->name} = document.getElementById('old{$field->name}').value;\n".
								 "		$row++;
								 "		if ($field->name == old{$field->name}) {\n".
								 "			compare++;\n".
								 "		}\n\n";
			}
		}
		if ($type != 'create') {
			$onsubmit = 'onsubmit="return validateForm()"';
			$startfunction = 'function validateForm() {'."\n".
					         '		let compare = 0;'."\n".
								$validationJS.
							 '		if (compare == '.$row.') {'."\n".
					         '			alert("les valeurs sont identiques");'."\n".
							 '			return false;'."\n".
							 '		}'."\n".
							 '		return true;'."\n".
							 '	}'."\n";
		}
        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>{$entityName} - <?= \$title ?></h2>

<form method="post" action="<?= site_url($action) ?>" $onsubmit>
$inputs
    <a href="<?= site_url('$entityName') ?>" class="btn btn-secondary mt-3">Retour</a>
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element) {
		element.value=element.value.toUpperCase();
	}

	$startfunction
</script>

<?= \$this->endSection() ?>
EOD;
    }
}

