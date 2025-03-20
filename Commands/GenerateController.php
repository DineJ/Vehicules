<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class GenerateController extends BaseCommand
{
    protected $group       = 'custom';
    protected $name        = 'generate:controller';
    protected $description = 'Génère automatiquement un contrôleur basé sur une entité.';

    public function run(array $params)
    {
        if (empty($params)) {
            CLI::error("❌ Veuillez spécifier le nom de l'entité.");
            return;
        }

        $entityName = ucfirst($params[0]);
        $modelName = $entityName . 'Model';
        $controllerName = $entityName . 'Controller';

        // Vérifier si l'entité existe
        if (!file_exists("../app/Entities/$entityName.php")) {
            CLI::error("❌ L'entité '$entityName' n'existe pas dans 'app/Entities/'.");
            return;
        }

        // Vérifier si le modèle existe
        if (!file_exists("../app/Models/$modelName.php")) {
            CLI::error("❌ Le modèle '$modelName' n'existe pas dans 'app/Models/'.");
            return;
        }

        // Choix du type de contrôleur (REST ou standard)
        CLI::write("Quel type de contrôleur souhaitez-vous générer ?");
        CLI::write("1. Contrôleur classique (avec méthodes show, create, update, delete)");
        CLI::write("2. Contrôleur RESTful (avec API)");

        $type = CLI::prompt("Entrez 1 ou 2", [1, 2]);

        if ($type == 1) {
            $controllerContent = $this->generateClassicController($controllerName, $modelName, $entityName);
        } else {
            $controllerContent = $this->generateRestController($controllerName, $modelName, $entityName);
        }

        // Écriture du fichier contrôleur
        $filePath = "../app/Controllers/$controllerName.php";
        file_put_contents($filePath, $controllerContent);

        CLI::write("✅ Contrôleur généré : app/Controllers/$controllerName.php", 'green');
    }

    private function generateClassicController($controllerName, $modelName, $entityName)
    {
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

    public function index()
    {
        return view('{$entityName}/index', ['items' => \$this->model->findAll()]);
    }

    public function show(\$id)
    {
        return view('{$entityName}/show', ['item' => \$this->model->find(\$id)]);
    }

    public function create()
    {
        \$data['title'] = 'Ajouter un nouvel {$entityName}';
        return view('{$entityName}/create', \$data);
    }

    public function store()
    {
        \$data = \$this->request->getPost();
        \$entity = new $entityName();
        \$entity->fill(\$data);
        
        if (!\$this->model->insert(\$entity)) {
            return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
        }
        
        return redirect()->to('/{$entityName}');
    }

    public function edit(\$id)
    {
        \$model = new $modelName();
        \$data['item'] = \$model->find(\$id);
        \$data['title'] = "Modifier {$entityName}";
        return view('{$entityName}/edit', \$data);
    }

    public function update(\$id)
    {
        \$data = \$this->request->getPost();
        \$entity = \$this->model->find(\$id);
        \$entity->fill(\$data);

        if (!\$this->model->save(\$entity)) {
            return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
        }

        return redirect()->to('/{$entityName}');
    }

    public function delete(\$id)
    {
        \$this->model->delete(\$id);
        return redirect()->to('/{$entityName}');
    }
}
EOD;
    }

    private function generateRestController($controllerName, $modelName, $entityName)
    {
        return <<<EOD
<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\\$modelName;
use App\Entities\\$entityName;

class $controllerName extends ResourceController
{
    protected \$modelName = $modelName::class;
    protected \$format    = 'json';

    public function index()
    {
        return $this->respond(\$this->model->findAll());
    }

    public function show(\$id = null)
    {
        \$item = \$this->model->find(\$id);
        if (\$item) {
            return $this->respond(\$item);
        }
        return $this->failNotFound('Non trouvé');
    }

    public function create()
    {
        \$data = \$this->request->getPost();
        \$entity = new $entityName();
        \$entity->fill(\$data);

        if (!\$this->model->insert(\$entity)) {
            return $this->failValidationErrors(\$this->model->errors());
        }

        return $this->respondCreated(\$entity);
    }

    public function update(\$id = null)
    {
        \$data = \$this->request->getRawInput();
        \$entity = \$this->model->find(\$id);
        if (!\$entity) {
            return $this->failNotFound('Non trouvé');
        }

        \$entity->fill(\$data);
        if (!\$this->model->save(\$entity)) {
            return $this->failValidationErrors(\$this->model->errors());
        }

        return $this->respondUpdated(\$entity);
    }

    public function delete(\$id = null)
    {
        if (!\$this->model->find(\$id)) {
            return $this->failNotFound('Non trouvé');
        }

        \$this->model->delete(\$id);
        return $this->respondDeleted(['message' => 'Supprimé']);
    }
}
EOD;
    }
}

