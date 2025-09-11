<?php

namespace App\Controllers;

use App\Models\Type_incidentModel;
use App\Entities\Type_incident;
use CodeIgniter\Controller;

class Type_incidentController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new Type_incidentModel();
	}

	// Display datas
	public function index()
	{
		$data['items'] = $this->model->paginate(5);
		$data['pager'] = $this->model->pager;

		return view('Type_incident/index', $data);
	}

	// Show an element
	public function show($id)
	{
		// Get id
		$data['item'] = $this->model->find($id);
		return view('Type_incident/show', $data);
	}

	// Creation form
	public function create()
	{
		// Get all datas
		$data['fromIncident'] = $this->request->getGet('from');
		$data['title'] = "Créer un type d'incident";
		return view('Type_incident/create', $data);
	}

	// Insert into DB
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Type_incident();
		$entity->fill($data);

		if (!$this->model->insert($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}

		$insertedId = $this->model->getInsertID();
		session()->setFlashdata('type_incident', $insertedId);

		if (isset($data['from']) && $data['from'] === 'incident')
		{
			return redirect()->to('/Incident/create?from=type_incident');
		}

		return redirect()->to('/Type_incident');
	}

	// Edit form
	public function edit($id)
	{
		// Get all datas
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Type d'incident";
		return view('Type_incident/edit', $data);
	}

	// Update datas
	public function update($id)
	{
		$data = $this->request->getPost();
		$data['critique'] = isset($data['critique']) ? 1 : 0;
		$entity = $this->model->find($id);
		$entity->fill($data);

		if (!$this->model->save($entity)) {
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		return redirect()->to('/Type_incident');
	}

	// Delete an element (not used)
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Type_incident');
	}
}