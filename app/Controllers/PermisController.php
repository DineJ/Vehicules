<?php

namespace App\Controllers;

use App\Models\PermisModel;
use App\Entities\Permis;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;

class PermisController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new PermisModel();
	}

	// LISTE AVEC PAGINATION
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Affiche 5 résultats par page
		$data['pager'] = $this->model->pager; // Ajoute le pager

		return view('Permis/index', $data);
	}

	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Permis/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create($id)
	{
		//$data = $this->request->getPost();
		$data['id_user'] = $id;
		$data['title'] = "Créer Permis";
		return view('Permis/create', $data);
	}

	// INSERTION DANS LA BASE
	public function store()
	{
		try {
			$data = $this->request->getPost();
			$entity = new Permis();
			$entity->fill($data);
			
			if (!$this->model->insert($entity)) {
				return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
			}
			
			return redirect()->to('/User/show/' .$data['id_user']);
		}
		
		catch (DatabaseException $e) {
			log_message('error', 'Erreur BDD : ' . $e->getMessage());
			echo "Erreur d'insertion : " . $e->getMessage();
		}
		catch (\Throwable $e) {
			log_message('error', 'Exception générale : ' . $e->getMessage());
			echo "Exception inattendue : " . $e->getMessage();
		}
		return redirect()->to('/Permis/edit/' .$data['id_user']);
	}

	// FORMULAIRE DE MODIFICATION
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Permis";
		return view('Permis/edit', $data);
	}

	// MISE À JOUR DES DONNÉES
	public function update($id)
	{
		try {
			$data = $this->request->getPost();
			$entity = $this->model->find($id);
			$entity->fill($data);

			if (!$this->model->save($entity)) {
				return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
			}

			return redirect()->to('/User/show/' .$data['id_user']);
		}

		catch (DatabaseException $e) {
			log_message('error', 'Erreur BDD : ' . $e->getMessage());
			echo "Erreur d'insertion : " . $e->getMessage();
		}
		catch (\Throwable $e) {
			log_message('error', 'Exception générale : ' . $e->getMessage());
			echo "Exception inattendue : " . $e->getMessage();
		}
		dd($this->request->getPost('date_permis'));
	}

	// SUPPRESSION D'UN ÉLÉMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Permis');
	}
}
