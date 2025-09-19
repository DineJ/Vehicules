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
		// Query
		$search = $this->request->getGet('q');

		// Query display
		$builder = $this->incidentModel->select('incident.id as incident_id, vehicule.plaque, incident.date_incident, suivi.date_intervention, suivi.description')
										->join('vehicule', 'vehicule.id = incident.id_vehicule', 'left')
										->join('suivi', 'suivi.id_incident = incident.id', 'left')
										->orderBy('vehicule.id');

		// Search bar query
		if ($search) {
			$query = '%' . $search . '%';
			$builder->like('vehicule.plaque', $query)
					->orLike('suivi.date_intervention', $query);
		}

		// Paginate directement sur le builder
		$data['items'] = $builder->paginate(5); // Display 5 results
		$data['pager'] = $builder->pager; // Add pager
		$data['search'] = $search;
		$data['page'] = 'index'; // Page identifier for css style

		return view('Suivi/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		$data['page'] = 'show'; // Page identifier for css style

		// Query to get datas
		$data['incident'] = $this->incidentModel
		->select('incident.id as incident_id, vehicule.id as vehicule_id, vehicule.plaque, incident.date_incident')
		->join('vehicule', 'vehicule.id = incident.id_vehicule', 'left')
		->find($data['item']->id_incident);

		return view('Suivi/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Suivi"; 
		$data['no_navbar'] = 'no-navbar';

		// Get ID from modal to pre-fill form
		$modal_incident_id = $this->request->getPost('modal_id_incident');

		// Check is function create is call by modal or classic way
		if (!empty($modal_incident_id))
		{
			$data['modal_incident_id'] = $modal_incident_id;
		}

		// Query to get datas
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

		// Query to get datas
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