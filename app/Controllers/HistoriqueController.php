<?php

namespace App\Controllers;

use App\Models\HistoriqueModel;
use App\Entities\Historique;
use CodeIgniter\Controller;

class HistoriqueController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new HistoriqueModel();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('Historique/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Historique/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['title'] = "Créer Historique";
		return view('Historique/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Historique();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Historique');
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Historique";
		return view('Historique/edit', $data);
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

		return redirect()->to('/Historique');
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Historique');
	}
}