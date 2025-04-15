<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateController extends BaseCommand
{
	protected $group       = 'custom';
	protected $name        = 'generate:controller';
	protected $description = 'Génère automatiquement un contrôleur basé sur une entité avec pagination.';
	protected $searchs = array();

	public function run(array $params)
	{
		if (empty($params)) {
			CLI::error("❌ Veuillez spécifier le nom de l'entité.");
			return;
		}

		$entityName = ucfirst($params[0]);
		if (isset($params[1]))
		{
			$this->searchs = explode(',',$params[1]);
		}

		$modelName = $entityName . 'Model';
		$controllerName = $entityName . 'Controller';
		$controllerPath = "../app/Controllers/$controllerName.php";

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

		// Générer le contenu du contrôleur avec pagination
		$controllerContent = $this->generateClassicController($controllerName, $modelName, $entityName);

		// Écriture du fichier contrôleur
		file_put_contents($controllerPath, $controllerContent);

		CLI::write("✅ Contrôleur généré : app/Controllers/$controllerName.php", 'green');
	}

	private function makeSearchBar($searchs)
	{
		if (count($searchs) == 0)
			return "";

		$searchBar = "// SEARCH BAR\n".
					 "		\$search = \$this->request->getGet('q');\n".
					"		if (\$search) \n".
					"		{\n".
					"			\$query = '%'.\$search. '%';\n".
					"			\$this->model->like('".$searchs[0]."', \$query)\n";

		for($x = 1; isset($searchs[$x]); $x++)
		{
			$searchBar .= "				->orLike('".$searchs[$x]."', \$query)\n";
		}
		$searchBar .= "				->orderBy('".$searchs[0]."');\n".
					  "		}\n".
					  "		else\n".
					  "		{\n".
					  "			\$this->model->orderBy('".$searchs[0]."');\n".
					  "		}\n".
					  "		\$data['search'] = \$search;";
		return $searchBar;
	}

	private function generateClassicController($controllerName, $modelName, $entityName)
	{
		$searchs = $this->makeSearchBar($this->searchs);
		return <<<EOD
<?php

namespace App\Controllers;

use App\Models\\$modelName;
use App\Entities\\$entityName;
use CodeIgniter\Controller;

class $controllerName extends Controller
{
	protected \$model;

	public function __construct()
	{
		\$this->model = new $modelName();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		$searchs
		\$data['items'] = \$this->model->paginate(5); // Affiche 5 résultats par page
		\$data['pager'] = \$this->model->pager; // Ajoute le pager

		return view('$entityName/index', \$data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show(\$id)
	{
		\$data['item'] = \$this->model->find(\$id);
		return view('$entityName/show', \$data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		\$data['title'] = "Créer $entityName";
		return view('$entityName/create', \$data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		\$data = \$this->request->getPost();
		\$entity = new $entityName();
		\$entity->fill(\$data);

		if (!\$this->model->insert(\$entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/$entityName');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit(\$id)
	{
		\$data['item'] = \$this->model->find(\$id);
		\$data['title'] = "Modifier $entityName";
		return view('$entityName/edit', \$data);
	}

	// MISE À JOUR DES DONNÉES
	public function update(\$id)
	{
		\$data = \$this->request->getPost();
		\$entity = \$this->model->find(\$id);
		\$entity->fill(\$data);

		if (!\$this->model->save(\$entity)) {
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		return redirect()->to('/$entityName');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete(\$id)
	{
		\$this->model->delete(\$id);
		return redirect()->to('/$entityName');
	}
}
EOD;
	}
}

