<?php

namespace App\Controllers;

use App\Models\VehiculeModel;
use App\Entities\Vehicule;
use CodeIgniter\Controller;

class VehiculeController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new VehiculeModel();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		// SEARCH BAR
		$search = $this->request->getGet('q');
		if ($search)
		{
			$query = '%'.$search.'%';
			$this->model->like('type_incident', $query)
						->orderBy('type_incident');
		}
		else
		{
			$this->model->orderBy('type_incident');
		}
		$data['search'] = $search;
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('Vehicule/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Vehicule/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['title'] = "Créer Vehicule";
		return view('Vehicule/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Vehicule();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Vehicule');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Vehicule";
		return view('Vehicule/edit', $data);
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

		return redirect()->to('/Vehicule');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Vehicule');
	}
}