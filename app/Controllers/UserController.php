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

	// LISTE AVEC PAGINATION
	public function index()
	{
		// SEARCH BAR
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
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('User/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('User/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['title'] = "Créer User";
		return view('User/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new User();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/User');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier User";
		return view('User/edit', $data);
	}

	// MISE À JOUR DES DONNÉES
	public function update($id)
	{
		$data = $this->request->getPost();
		$entity = $this->model->find($id);
		$entity->fill($data);

		if (!$this->model->save($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		return redirect()->to('/User');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/User');
	}
}