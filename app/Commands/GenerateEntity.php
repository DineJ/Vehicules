<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use Config\Database;
use CodeIgniter\Validation\Validation;

class GenerateEntity extends BaseCommand
{
	protected $group       = 'custom';
	protected $name        = 'generate:entity';
	protected $description = 'Génère automatiquement une entité avec validation basée sur un modèle CodeIgniter.';

	public function run(array $params)
	{
		if (empty($params)) {
			CLI::error("❌ Veuillez spécifier le nom du modèle à utiliser.");
			return;
		}

		$modelName = ucfirst($params[0]);
		$modelClass = "App\\Models\\$modelName";

		if (!class_exists($modelClass)) {
			CLI::error("❌ Le modèle '$modelName' n'existe pas dans 'app/Models/'.");
			return;
		}

		// Charger le modèle
		$model = new $modelClass();
		$db = Database::connect();

		if (!isset($model->table)) {
			CLI::error("❌ Le modèle '$modelName' n'a pas de propriété \$table définie.");
			return;
		}

		$table = $model->table;
		$fields = $db->getFieldData($table);

		if (!$fields) {
			CLI::error("❌ Impossible de récupérer les champs pour la table '$table'.");
			return;
		}

		$entityName = ucfirst($table);
		$properties = [];
		$casts = [];
		$methods = [];
		$rules = [];

		foreach ($fields as $field) {
			$propertyName = lcfirst(str_replace('_', '', ucwords($field->name, '_')));
			$properties[] = " * @property $" . $field->name;
			$type = $this->mapType($field->type);
			$casts[] = "        '{$field->name}' => '{$type}',";

			// Définition des règles de validation
			$validationRules = $this->getValidationRules($type, $field);
			$rules[] = "        '{$field->name}' => '" . implode('|', $validationRules) . "',";

			// Génération du getter
			$methods[] = <<<EOD
	public function get{$propertyName}()
	{
		return \$this->attributes['{$field->name}'] ?? null;
	}
EOD;

			// Génération du setter avec validation
			$methods[] = <<<EOD
	public function set{$propertyName}(\${$propertyName})
	{
		\$validation = \Config\Services::validation();
		\$validation->setRules(['{$field->name}' => '{$validationRules[0]}']);

		if (!\$validation->run(['{$field->name}' => \${$propertyName}])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour '{$field->name}': " . implode(', ', \$validation->getErrors()));
		}

		\$this->attributes['{$field->name}'] = \${$propertyName};
		return \$this;
	}
EOD;
		}

		// Génération du contenu de l'entité
		$entityContent = "<?php\n\n";
		$entityContent .= "namespace App\Entities;\n\n";
		$entityContent .= "use CodeIgniter\Entity\Entity;\n";
		$entityContent .= "use CodeIgniter\Validation\ValidationException;\n\n";
		$entityContent .= "/**\n";
		$entityContent .= " * Class $entityName\n";
		$entityContent .= " *\n";
		$entityContent .= implode("\n", $properties) . "\n";
		$entityContent .= " */\n";
		$entityContent .= "class $entityName extends Entity\n";
		$entityContent .= "{\n";
		$entityContent .= "    protected \$casts = [\n";
		$entityContent .= implode("\n", $casts) . "\n";
		$entityContent .= "    ];\n\n";
		$entityContent .= "    protected \$validationRules = [\n";
		$entityContent .= implode("\n", $rules) . "\n";
		$entityContent .= "    ];\n\n";
		$entityContent .= implode("\n\n", $methods) . "\n";
		$entityContent .= "}\n";

		// Écriture dans le fichier
		$filePath = "../app/Entities/$entityName.php";
		file_put_contents($filePath, $entityContent);

		CLI::write("✅ Entité générée avec validation : app/Entities/$entityName.php", 'green');
	}

	private function mapType($dbType)
	{
		$typeMapping = [
			'int'     => 'integer',
			'tinyint' => 'boolean',
			'varchar' => 'string',
			'text'    => 'string',
			// 'date'    => 'date',
			'date'    => 'datetime',
			'datetime'=> 'datetime',
			'float'   => 'float',
			'double'  => 'double'
		];

		foreach ($typeMapping as $key => $type) {
			if (stripos($dbType, $key) !== false) {
				return $type;
			}
		}

		return 'string';
	}

	private function getValidationRules($type, $field)
	{
		$rules = [];

		switch ($type) {
			case 'integer':
				$rules[] = 'integer';
				if ($field->max_length) {
					$rules[] = "max_length[{$field->max_length}]";
				}
				break;
			case 'boolean':
				$rules[] = 'in_list[0,1]';
				break;
			case 'string':
				$rules[] = 'string';
				if ($field->max_length) {
					$rules[] = "max_length[{$field->max_length}]";
				}
				break;
			case 'date':
				$rules[] = 'valid_date';
				break;
			case 'datetime':
				$rules[] = 'valid_date[Y-m-d H:i:s]';
				break;
			case 'float':
			case 'double':
				$rules[] = 'decimal';
				break;
			default:
				$rules[] = 'string';
		}

		return $rules;
	}
}

