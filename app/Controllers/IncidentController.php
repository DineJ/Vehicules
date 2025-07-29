<?php

namespace App\Controllers;

use App\Models\IncidentModel;
use App\Models\UserModel;
use App\Models\VehiculeModel;
use App\Models\Type_incidentModel;
use App\Entities\Incident;
use CodeIgniter\Controller;

class IncidentController extends Controller
{
	protected $model;
	protected $userModel;
	protected $vehiculeModel;
	protected $typeIncidentModel;

	public function __construct()
	{
		$this->model = new IncidentModel();
		$this->userModel = new UserModel();
		$this->vehiculeModel = new VehiculeModel();
		$this->typeIncidentModel = new Type_incidentModel();
	}


	// Display datas
	public function index()
	{
		$data['items'] = $this->model->paginate(5);
		$data['pager'] = $this->model->pager;

		// user_id
		$utilisateurs = $this->userModel->findAll();
		$userMap = [];
		foreach ($utilisateurs as $u) {
			$userMap[$u->id] = $u->prenom . ' ' . $u->nom;
		}

		// vehicule_id
		$vehicules = $this->vehiculeModel->findAll();
		$vehiculeMap = [];
		foreach ($vehicules as $v) {
			$vehiculeMap[$v->id] = $v->plaque;
		}

		// type_incident_id
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


	// AFFICHAGE D'UN SEUL ÉLÉMENT
	public function show($id)
	{
		// Get id
		$data['item'] = $this->model->find($id);

		// Get datas linked by user_id
		$data['utilisateur'] = $this->userModel->find($data['item']->id_user);
		$data['vehicule'] = $this->vehiculeModel->find($data['item']->id_vehicule);
		$data['type_incident'] = $this->typeIncidentModel->find($data['item']->id_type_incident);

		return view('Incident/show', $data);
	}

	// FORMULAIRE DE CRÉATION
	public function create()
	{

		$data['utilisateurs'] = $this->userModel->findAll();
		$data['vehicules'] = $this->vehiculeModel->findAll();
		$data['types_incident'] = $this->typeIncidentModel->findAll();
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

		// Get all datas
		$data['utilisateurs'] = $this->userModel->findAll();
		$data['vehicules'] = $this->vehiculeModel->findAll();
		$data['types_incident'] = $this->typeIncidentModel->findAll();

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