<?php

namespace App\Controllers;

use App\Models\VehiculeModel;
use App\Models\IncidentModel;
use App\Models\AssuranceModel;
use App\Entities\Vehicule;
use CodeIgniter\Controller;

class VehiculeController extends Controller
{
	protected $model;
	protected $incidentModel;

	public function __construct()
	{
		$this->model = new VehiculeModel();
		$this->incidentModel = new IncidentModel();
		$this->assuranceModel = new AssuranceModel();
	}

	// SEARCH BAR
	public function index()
	{
		$search = $this->request->getGet('q');

		if ($search)
		{
			$query = '%'.$search.'%';
			$this->model->like('plaque', $query)
						->orderBy('modele');
		}
		else
		{
			$this->model->orderBy('modele');
		}

		$data['search'] = $search;
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Vehicule/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['page'] = 'show';
		$data['item'] = $this->model->find($id);

		// Query to get datas
		$data['incident'] = $this->incidentModel
		->select('incident.id as id, vehicule.plaque as vehicule, CONCAT(user.prenom, " ", user.nom) as user, type_incident.nom as typeIncident, date_incident, explication_incident')
		->join('vehicule', 'vehicule.id = incident.id_vehicule', 'left')
		->join('type_incident', 'type_incident.id = incident.id_type_incident', 'left')
		->join('user', 'user.id = incident.id_user', 'left')
		->where('incident.id_vehicule', $id)
		->findAll();

		$data['assurance'] = $this->assuranceModel
			->select('MAX(assurance.id), assurance.date_contrat, assurance.nom_assurance')
			->join('assurance_vehicule', 'assurance_vehicule.id_assurance = assurance.id', 'left')
			->where('assurance_vehicule.id_vehicule', $id)
			->groupBy('assurance.id')
			->orderBy('assurance.id', 'DESC')
			->findAll();

		$data['incidentId'] = $data['incident'][0];
		$data['assuranceId'] = $data['assurance'][0];
		return view('Vehicule/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Vehicule";
		return view('Vehicule/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Vehicule();
		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Vehicule');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Vehicule";
		return view('Vehicule/edit', $data);
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

			return redirect()->to('/Vehicule');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Vehicule');
	}
}
