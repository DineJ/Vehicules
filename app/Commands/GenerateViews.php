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
	</form>
</div>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateFormView($entityName, $fields, $type)
    {
        $action = $type === 'create' ? "$entityName/store" : "$entityName/update/\$item->id";
        
        $inputs = "";

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
            $inputs .= "<label>{$field->name}</label>\n";
            $inputs .= "<input type='$inputType' onchange='setUpper(document.getElementById('$field->name'));' id='{$field->name}' name='{$field->name}' value='<?= isset(\$item) ? \$item->{$field->name} : '' ?>' class='form-control' required>\n";
        }

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>{$entityName} - <?= \$title ?></h2>

<form method="post" action="<?= site_url('$action') ?>">
    $inputs
    <a href="<?= site_url('$entityName') ?>" class="btn btn-secondary mt-3">Retour</a>
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element) {
		element.value=element.value.toUpperCase();
	}
</script>

<?= \$this->endSection() ?>
EOD;
    }
}

