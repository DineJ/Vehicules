<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Entities\Incident;
use CodeIgniter\Controller;

class IncidentController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new IncidentModel();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('Incident/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Incident/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['title'] = "Créer Incident";
		return view('Incident/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Incident();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Incident');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Incident";
		return view('Incident/edit', $data);
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

		return redirect()->to('/Incident');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Incident');
	}
}