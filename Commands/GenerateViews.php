<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

use App\Models\UsersModel;

class GenerateViews extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'generate:views';
    protected $description = 'Génère automatiquement les vues CRUD pour une entité.';

    public function run(array $params)
    {
        if (empty($params)) {
            CLI::error("❌ Veuillez spécifier le nom de l'entité.");
            return;
        }

        $entityName = ucfirst($params[0]);
        $modelName = $entityName . 'Model';
        $folderPath = "../app/Views/{$entityName}";

        // Vérifier si l'entité existe
        if (!file_exists("../app/Entities/$entityName.php")) {
            CLI::error("❌ L'entité '$entityName' n'existe pas.");
            return;
        }

        // Vérifier si le modèle existe
        if (!file_exists("../app/Models/$modelName.php")) {
            CLI::error("❌ Le modèle '$modelName' n'existe pas.");
            return;
        }

        // Récupérer les champs de la table
        $db = Database::connect();
	$modelName = "App\\Models\\" . $entityName . "Model";
	if (!class_exists($modelName)) {
    		CLI::error("❌ Le modèle '$modelName' n'existe pas.");
    		return;
	}
	$model = new $modelName();
	// $model = new $modelName();
	// $model = new UsersModel();
        $table = $model->table;
        $fields = $db->getFieldNames($table);

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
        $columns = implode("\n                    ", array_map(fn($f) => "<th>$f</th>", $fields));
        $rows = implode("\n                    ", array_map(fn($f) => "<td><?= \$item->$f ?></td>", $fields));

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>Liste des {$entityName}s</h2>
<a href="<?= site_url('$entityName/create') ?>" class="btn btn-success">Ajouter</a>
<table class="table table-bordered mt-3">
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
                <a href="<?= site_url('$entityName/edit/'.\$item->id) ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= site_url('$entityName/delete/'.\$item->id) ?>" class="btn btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateShowView($entityName, $fields)
    {
        $details = implode("\n        ", array_map(fn($f) => "<p><strong>$f:</strong> <?= \$item->$f ?></p>", $fields));

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>Détails de {$entityName}</h2>
$details
<a href="<?= site_url('$entityName') ?>" class="btn btn-secondary">Retour</a>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateFormView($entityName, $fields, $type)
    {
        $action = $type === 'create' ? "$entityName/store" : "$entityName/update/<?= \$item->id ?>";
        $inputs = implode("\n            ", array_map(fn($f) => "<label>$f</label><input type='text' name='$f' value='<?= isset(\$item) ? \$item->$f : '' ?>' class='form-control'>", $fields));

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>{$entityName} - <?= \$title ?></h2>
<form method="post" action="<?= site_url('$action') ?>">
    $inputs
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>
<a href="<?= site_url('$entityName') ?>" class="btn btn-secondary mt-3">Retour</a>

<?= \$this->endSection() ?>
EOD;
    }
}

