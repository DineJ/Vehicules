<?php

namespace App\Controllers;

use App\Models\AssuranceModel;
use App\Models\Assurance_vehiculeModel;
use App\Models\VehiculeModel;
use App\Entities\Assurance;
use App\Entities\Assurance_vehicule;
use App\Entities\Vehicule;
use CodeIgniter\Controller;

class AssuranceController extends Controller
{
	protected $model;
	protected $assurance_vehiculeModel;
	protected $vehiculeModel;

	public function __construct()
	{
		$this->model = new AssuranceModel();
		$this->assurance_vehiculeModel = new Assurance_vehiculeModel();
		$this->vehiculeModel = new VehiculeModel();
	}

	// DISPLAY ALL ELEMENT
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Assurance/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
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

		// Query to get ids from actif vehicules
		$entity2Query = $this->vehiculeModel->select('id')->where('actif', 1)->findAll();

		// Loop for each row from the previous query
		foreach ($entity2Query as $e)
		{
			$entity2 = new Assurance_vehicule(); // Create an entity for each row
			$entity2->id_assurance = $this->model->getInsertID(); // Fill id_assurance
			$entity2->id_vehicule = $e->id; // Fill id_vehicule

			// Insert in the DB
			if (!$this->assurance_vehiculeModel->insert($entity2) === false)
			{
				return redirect()->back()->with('error', 'Erreur lors de l\'ajout2.');
			}
		}

		return redirect()->to('/Assurance');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
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
