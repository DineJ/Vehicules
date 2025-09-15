<?php

namespace App\Controllers;

use App\Models\SuiviModel;
use App\Models\IncidentModel;
use App\Entities\Suivi;
use CodeIgniter\Controller;

class SuiviController extends Controller
{
	protected $model;
	protected $incidentModel;

	public function __construct()
	{
		$this->model = new SuiviModel();
		$this->incidentModel = new IncidentModel();
	}

	// SEARCH BAR
	public function index()
	{
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager
		return view('Suivi/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		$data['incident'] = $this->incidentModel->find($data['item']->id_incident);

		return view('Suivi/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Suivi";
		$data['incidents'] = $this->incidentModel
		->select('incident.id as incident_id, vehicule.id as vehicule_id, vehicule.plaque, incident.date_incident')
		->join('vehicule', 'vehicule.id = incident.id_vehicule', 'left')
		->findAll();


		return view('Suivi/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Suivi();
		$entity->fill($data);
		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Suivi');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Suivi";
		$data['incidents'] = $this->incidentModel
		->select('incident.id as incident_id, vehicule.id as vehicule_id, vehicule.plaque, incident.date_incident')
		->join('vehicule', 'vehicule.id = incident.id_vehicule', 'left')
		->findAll();

		return view('Suivi/edit', $data);
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

		return redirect()->to('/Suivi');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Suivi');
	}
}