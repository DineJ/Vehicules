<?php

namespace App\Controllers;

use App\Models\Type_incidentModel;
use App\Entities\Type_incident;
use CodeIgniter\Controller;

class Type_incidentController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new Type_incidentModel();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('Type_incident/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Type_incident/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['fromIncident'] = $this->request->getGet('from');
		$data['title'] = "Créer Type_incident";
		return view('Type_incident/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Type_incident();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}

		if (isset($data['from']) && $data['from'] === 'incident')
		{
			return redirect()->to('/Incident/create');
		}

		return redirect()->to('/Type_incident');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Type_incident";
		return view('Type_incident/edit', $data);
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

		return redirect()->to('/Type_incident');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Type_incident');
	}
}