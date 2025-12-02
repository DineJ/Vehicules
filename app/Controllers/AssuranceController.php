<?php

namespace App\Controllers;

use App\Models\AssuranceModel;
use App\Entities\Assurance;
use CodeIgniter\Controller;

class AssuranceController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new AssuranceModel();
	}

	// SEARCH BAR
	public function index()
	{
		$builder = $this->model
			->select('assurance.id as id, assurance_vehicule.id_vehicule as id_vehicule, vehicule.plaque as plaque, nom_assurance, date_contrat')
			->join('assurance_vehicule', 'assurance_vehicule.id_assurance = id', 'left')
			->join('vehicule', 'vehicule.id = assurance_vehicule.id_vehicule', 'left')
			->orderBy('vehicule.id');

		
		$data['items'] = $builder->paginate(5); // Display 5 results
		$data['pager'] = $builder->pager; // Add pager

		return view('Assurance/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$builder = $this->model
		->select('assurance.id as id, assurance_vehicule.id_vehicule as id_vehicule, vehicule.plaque as plaque, nom_assurance, date_contrat')
		->join('assurance_vehicule', 'assurance_vehicule.id_assurance = id', 'left')
		->join('vehicule', 'vehicule.id = assurance_vehicule.id_vehicule', 'left')
		->orderBy('vehicule.id');

		$data['item'] = $builder->find($id);
		return view('Assurance/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Assurance";
		return view('Assurance/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Assurance();
		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Assurance');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$builder = $this->model
		->select('assurance.id as id, assurance_vehicule.id_vehicule as id_vehicule, vehicule.plaque as plaque, nom_assurance, date_contrat')
		->join('assurance_vehicule', 'assurance_vehicule.id_assurance = id', 'left')
		->join('vehicule', 'vehicule.id = assurance_vehicule.id_vehicule', 'left')
		->orderBy('vehicule.id');

		$data['item'] = $builder->find($id);
		$data['title'] = "Modifier Assurance";
		return view('Assurance/edit', $data);
	}


	// UPDATE DATABASE
	public function update($id)
	{
		$data = $this->request->getPost();
		$entity = $this->model->find($id);
		$entity->fill($data);

		if (!$this->model->save($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		return redirect()->to('/Assurance');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Assurance');
	}
}