<?php

namespace App\Controllers;

use App\Models\InfractionModel;
use App\Entities\Infraction;
use CodeIgniter\Controller;

class InfractionController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new InfractionModel();
	}

	// SEARCH BAR
	public function index()
	{
		
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Infraction/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		// Query to get only the license plate
		$data['vehicule'] = $this->model
			->select('vehicule.plaque')
			->join('mission', 'infraction.id_mission = mission.id', 'left')
			->join('vehicule', 'mission.id_vehicule = vehicule.id', 'left')
			->where('infraction.id', $id)
			->get()
			->getRow('plaque');

		$data['item'] = $this->model->find($id);
		return view('Infraction/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		// Retrive the id of modal_id to prefill a form
		$data['missionId'] = ($this->request->getPost('modal_id') ?? $this->request->getGet('modal_id'));
		$data['title'] = "Créer Infraction";
		$data['no_navbar'] = 'no-navbar';
		return view('Infraction/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Infraction();
		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Infraction');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Infraction";
		$data['no_navbar'] = 'no-navbar';
		return view('Infraction/edit', $data);
	}


	// UPDATE DATABASE
	public function update($id)
	{
		$data = $this->request->getPost();
		$data['stationnement'] = isset($data['stationnement']) ? 1 : 0;
		$entity = $this->model->find($id);
		$entity->fill($data);

		if (!$this->model->save($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de la mise à jour.');
		}

		return redirect()->to('/Infraction');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Infraction');
	}
}
