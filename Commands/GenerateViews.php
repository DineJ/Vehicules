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

<?= \$pager->links() ?>

<?= \$this->endSection() ?>
EOD;
    }

    private function generateShowView($entityName, $fields)
    {
        $details = implode("\n        ", array_map(fn($f) => "<p><strong>$f->name:</strong> <?= \$item->{$f->name} ?></p>", $fields));

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
        $action = $type === 'create' ? "$entityName/store" : "$entityName/update/\$item->id";
        
        $inputs = "";
        $validationJS = "";

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
            $inputs .= "<input type='$inputType' id='{$field->name}' name='{$field->name}' value='<?= isset(\$item) ? \$item->{$field->name} : '' ?>' class='form-control' required>\n";

            // Ajout de validation JS
            $validationJS .= "let {$field->name} = document.getElementById('{$field->name}');\n";
            $validationJS .= "if ({$field->name}.value.trim() === '') {\n";
            $validationJS .= "    alert('Le champ {$field->name} est obligatoire.');\n";
            $validationJS .= "    {$field->name}.focus();\n";
            $validationJS .= "    return false;\n";
            $validationJS .= "}\n";
        }

        return <<<EOD
<?= \$this->extend('layouts/main') ?>
<?= \$this->section('content') ?>

<h2>{$entityName} - <?= \$title ?></h2>

<form method="post" action="<?= site_url('$action') ?>" onsubmit="return validateForm()">
    $inputs
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<a href="<?= site_url('$entityName') ?>" class="btn btn-secondary mt-3">Retour</a>

<script>
function validateForm() {
    $validationJS
    return true;
}
</script>

<?= \$this->endSection() ?>
EOD;
    }
}

