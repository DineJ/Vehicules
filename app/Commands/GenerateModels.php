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
	$table = $params[0];
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
			$modelContent .= "\tprotected \$table = '$table';\n";
			$modelContent .= "\tprotected \$primaryKey = '$primaryKey';\n";
			$modelContent .= "\tprotected \$returnType = 'App\Entities\\$entityName';\n";
			$modelContent .= "\tprotected \$allowedFields = ['" . implode("', '", $allowedFields) . "'];\n";
			$modelContent .= "}\n";

			file_put_contents("../app/Models/$modelName.php", $modelContent);
		CLI::write("✅ Modèle générés pour la table: `$table`", 'green');
		// }
	}
}