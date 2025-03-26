<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class GenerateModels extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'generate:models';
    protected $description = 'Génère automatiquement les modèles et entités depuis la base de données.';

    public function run(array $params)
    {
        $db = Database::connect();
        // $tables = $db->listTables();
	$table = $params[0];
        // foreach ($tables as $table) {
            $fields = $db->getFieldData($table);
            $primaryKey = null;
            $allowedFields = [];

            foreach ($fields as $field) {
                if ($field->primary_key) {
                    $primaryKey = $field->name;
                } else {
                    $allowedFields[] = $field->name;
                }
            }

            if (!$primaryKey) {
                CLI::error("⚠️  Aucune clé primaire trouvée pour la table `$table`, un modèle sans clé primaire sera généré.");
            }

            $modelName = ucfirst($table) . 'Model';
            $entityName = ucfirst($table);

            // Génération du modèle
            $modelContent = "<?php\n\n";
            $modelContent .= "namespace App\Models;\n\n";
            $modelContent .= "use CodeIgniter\Model;\n\n";
            $modelContent .= "class $modelName extends Model\n";
            $modelContent .= "{\n";
            $modelContent .= "    protected \$table = '$table';\n";
            $modelContent .= "    protected \$primaryKey = '$primaryKey';\n";
            $modelContent .= "    protected \$returnType = 'App\Entities\\$entityName';\n";
            $modelContent .= "    protected \$allowedFields = ['" . implode("', '", $allowedFields) . "'];\n";
            $modelContent .= "}\n";

            file_put_contents("../app/Models/$modelName.php", $modelContent);
/*
            // Génération de l'entité
            $entityContent = "<?php\n\n";
            $entityContent .= "namespace App\Entities;\n\n";
            $entityContent .= "use CodeIgniter\Entity\Entity;\n\n";
            $entityContent .= "class $entityName extends Entity\n";
            $entityContent .= "{\n";
            $entityContent .= "    // Ajoute ici des méthodes pour manipuler les données si besoin\n";
            $entityContent .= "}\n";

            file_put_contents("../app/Entities/$entityName.php", $entityContent);

	    CLI::write("✅ Modèle et entité générés pour la table: `$table`", 'green');
*/
	    CLI::write("✅ Modèle générés pour la table: `$table`", 'green');
        // }
    }
}

/*


namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;

class GenerateModels extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'generate:models';
    protected $description = 'Génère automatiquement les modèles et entités depuis la base de données.';

    public function run(array $params)
    {
        $db = Database::connect();

        $table = ucfirst($params[0]) . 'Controller';
        $fields = $db->getFieldData($table);
        $primaryKey = null;
        $allowedFields = [];

        foreach ($fields as $field) {
            if ($field->primary_key) {
                $primaryKey = $field->name;
            } else {
                $allowedFields[] = $field->name;
            }
        }

        if (!$primaryKey) {
            CLI::error("⚠️  Aucune clé primaire trouvée pour la table `$table`, un modèle sans clé primaire sera généré.");
        }

	CLI::write("Chemin d'exécution : " . getcwd());



        $modelName = ucfirst($table) . 'Model';

        // Génération du modèle
        $modelContent = "<?php\n\n";
        $modelContent .= "namespace App\Models;\n\n";
        $modelContent .= "use CodeIgniter\Model;\n\n";
        $modelContent .= "class $modelName extends Model\n";
        $modelContent .= "{\n";
        $modelContent .= "    protected \$table = '$table';\n";
        $modelContent .= "    protected \$primaryKey = '$primaryKey';\n";
        $modelContent .= "    protected \$returnType = 'App\Entities\\$entityName';\n";
        $modelContent .= "    protected \$allowedFields = ['" . implode("', '", $allowedFields) . "'];\n";
        $modelContent .= "}\n";

        file_put_contents("../app/Models/".$modelName.".php", $modelContent);

        CLI::write("✅ Modèle générés pour la table: `$table`", 'green');
    }
}
*/

