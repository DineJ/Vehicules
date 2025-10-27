<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateRoutes extends BaseCommand
{
	protected $group       = 'custom';
	protected $name        = 'generate:routes';
	protected $description = 'Ajoute automatiquement les routes pour un contrôleur en les insérant à un endroit spécifique.';

	public function run(array $params)
	{
		if (empty($params)) {
			CLI::error("❌ Veuillez spécifier le nom de l'entité.");
			return;
		}

		// Correction du nom en mettant la première lettre en majuscule
		$entityName = ucfirst(strtolower($params[0]));
		$controllerName = $entityName . 'Controller';
		$controllerPath = "../app/Controllers/$controllerName.php";
		$routeFilePath = "../app/Config/Routes.php";

		// Vérifier si le contrôleur existe
		if (!file_exists($controllerPath)) {
			CLI::error("❌ Le contrôleur '$controllerName' n'existe pas.");
			return;
		}

		// Définition des routes avec la première lettre en majuscule
		$routesToAdd = [
			"\$routes->get('$entityName', '$controllerName::index');",
			"\$routes->get('$entityName/show/(:num)', '$controllerName::show/\$1');",
			"\$routes->get('$entityName/create', '$controllerName::create');",
			"\$routes->post('$entityName/store', '$controllerName::store');",
			"\$routes->get('$entityName/edit/(:num)', '$controllerName::edit/\$1');",
			"\$routes->post('$entityName/update/(:num)', '$controllerName::update/\$1');",
			"\$routes->get('$entityName/delete/(:num)', '$controllerName::delete/\$1');",
		];

		// Lire le fichier `Routes.php`
		$routeFileContent = file_get_contents($routeFilePath);

		// Vérifier si les routes existent déjà
		$routesAlreadyExist = false;
		foreach ($routesToAdd as $route) {
			if (strpos($routeFileContent, $route) !== false) {
				$routesAlreadyExist = true;
				break;
			}
		}

		if ($routesAlreadyExist) {
			CLI::error("⚠️  Les routes pour '$entityName' existent déjà.");
			return;
		}

		// Trouver l'endroit où insérer les routes (après un commentaire spécifique)
		$marker = "// Auto-generated routes";
		if (strpos($routeFileContent, $marker) !== false) {
			$newRoutes = "\n// Routes for $entityName\n" . implode("\n", $routesToAdd) . "\n";

			// Insérer après le marqueur
			$routeFileContent = str_replace($marker, $marker . "\n" . $newRoutes, $routeFileContent);
		} else {
			// Si le marqueur n'existe pas, ajouter les routes à la fin
			CLI::error("⚠️  Le marqueur '$marker' n'a pas été trouvé dans `Routes.php`. Ajout en fin de fichier.");
			$newRoutes = "\n// Routes for $entityName\n" . implode("\n", $routesToAdd) . "\n";
			$routeFileContent .= $newRoutes;
		}

		// Écrire le fichier
		file_put_contents($routeFilePath, $routeFileContent);

		CLI::write("✅ Routes ajoutées avec succès pour '$entityName' dans `app/Config/Routes.php`", 'green');
	}
}