<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\UserModel;
use App\Models\SuiviModel;
use App\Models\VehiculeModel;
use App\Models\Type_incidentModel;
use App\Entities\Incident;
use CodeIgniter\Controller;

class IncidentController extends Controller
{
	protected $model;
	protected $userModel;
	protected $suiviModel;
	protected $vehiculeModel;
	protected $typeIncidentModel;

	public function __construct()
	{
		$this->model = new IncidentModel();
		$this->userModel = new UserModel();
		$this->suiviModel = new  SuiviModel();
		$this->vehiculeModel = new VehiculeModel();
		$this->typeIncidentModel = new Type_incidentModel();
	}


	// Display datas
	public function index()
	{
		$data['items'] = $this->model->paginate(5);
		$data['pager'] = $this->model->pager;
		$data['page'] = 'index';

		// User_id
		$utilisateurs = $this->userModel->findAll();
		$userMap = [];
		foreach ($utilisateurs as $u) {
			$userMap[$u->id] = $u->prenom . ' ' . $u->nom;
		}

		// Vehicule_id
		$vehicules = $this->vehiculeModel->findAll();
		$vehiculeMap = [];
		foreach ($vehicules as $v) {
			$vehiculeMap[$v->id] = $v->plaque;
		}

		// Type_incident_id
		$types = $this->typeIncidentModel->findAll();
		$typeIncidentMap = [];
		foreach ($types as $t) {
			$typeIncidentMap[$t->id] = $t->nom;
		}

		// Past datas to the view
		$data['userMap'] = $userMap;
		$data['vehiculeMap'] = $vehiculeMap;
		$data['typeIncidentMap'] = $typeIncidentMap;

		return view('Incident/index', $data);
	}


	// Show an element
	public function show($id)
	{
		$data['page'] = 'show';

		// Get id
		$data['item'] = $this->model->find($id);
		$data['suivi'] = $this->suiviModel->where('id_incident', $data['item']->id)->findAll();

		// Get datas linked by user_id
		$data['utilisateur'] = $this->userModel->find($data['item']->id_user);
		$data['vehicule'] = $this->vehiculeModel->find($data['item']->id_vehicule);
		$data['type_incident'] = $this->typeIncidentModel->find($data['item']->id_type_incident);

		return view('Incident/show', $data);
	}


	// Creation form
	public function create()
	{
		$selectedUserId = $this->request->getGet('user');
		$selectedTypeIncident = session()->getFlashdata('type_incident');

		// Get all datas
		$data['utilisateurs'] = $this->userModel->findAll();
		$data['vehicules'] = $this->vehiculeModel->findAll();
		$data['types_incident'] = $this->typeIncidentModel->findAll();
		$data['title'] = "Créer Incident";
		$data['selectedUserId'] = $selectedUserId;
		$data['selectedTypeIncident'] = $selectedTypeIncident;
		$data['fromTypeIncident'] = $this->request->getGet('from');

		return view('Incident/create', $data);
	}


	// Insert into DB
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


	// Edit form
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);

		// Get all datas
		$data['utilisateurs'] = $this->userModel->findAll();
		$data['vehicules'] = $this->vehiculeModel->findAll();
		$data['types_incident'] = $this->typeIncidentModel->findAll();

		$data['title'] = "Modifier Incident";
		return view('Incident/edit', $data);
	}


	// Update datas
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


	// Delete an element (not used)
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Incident');
	}
}