<?php

namespace App\Controllers;

use App\Models\LieuModel;
use App\Entities\Lieu;
use CodeIgniter\Controller;

class LieuController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new LieuModel();
	}

	// SEARCH BAR
	public function index()
	{
		
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Lieu/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Lieu/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Lieu";
		return view('Lieu/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Lieu();

		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Lieu');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Lieu";
		return view('Lieu/edit', $data);
	}


	// UPDATE DATABASE
	public function update($id)
	{
		$data = $this->request->getPost();
		$entity = $this->model->find($id);
		$redirect_url = $this->request->getPost('redirect_url');
		$entity->fill($data);

		if (!$this->model->save($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		// Redirection vers l'URL d'origine
		if (!empty($redirect_url))
		{
			return redirect()->to($redirect_url);
		}

		return redirect()->to('/Lieu');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Lieu');
	}
}
