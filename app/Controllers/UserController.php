<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\Controller;

class UserController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new UserModel();
	}

	// SEARCH BAR
	public function index()
	{
		$search = $this->request->getGet('q');

		if ($search)
		{
			$query = '%'.$search.'%';
			$this->model->like('nom', $query)
						->orLike('prenom', $query)
						->orLike('mail', $query)
						->orLike('telephone', $query)
						->orderBy('nom');
		}
		else
		{
			$this->model->orderBy('nom');
		}

		$data['search'] = $search;
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('User/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('User/show', $data);
	}


	// CREATION FORM 
	public function create()
	{
		$data['title'] = "Créer User";
		return view('User/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$data['clef_connexion'] = md5($data['clef_connexion']);
		$entity = new User();
		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/User');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier User";
		return view('User/edit', $data);
	}


	// UPDATE DATABASE
		public function update($id)
		{
			$data = $this->request->getPost();
			$entity = $this->model->find($id);

			$Changed = false;

			$data['admin'] = isset($data['admin']) ? 1 : 0;

			if (!empty($data['clef_connexion'])) {
				$data['clef_connexion'] = md5($data['clef_connexion']);
				if ($data['clef_connexion'] !== $entity->clef_connexion) {
					$entity->clef_connexion = $data['clef_connexion'];
					$Changed = true;
				}
			}
			unset($data['clef_connexion']); 

			array_walk($data, function($value, $key) use ($entity, &$Changed) {
				if (isset($entity->$key) && $entity->$key != $value) {
					$entity->$key = $value;
					$Changed = true;
				}
			});

			if (!$Changed) {
				return redirect()->back()->with('error', 'Aucune donnée modifiée.');
			}

			if (!$this->model->save($entity)) {
				return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
			}

			return redirect()->to('/User');
		}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/User');
	}
}