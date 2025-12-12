<?php

namespace App\Controllers;

use App\Models\MissionModel;
use App\Entities\Mission;
use CodeIgniter\Controller;

class MissionController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new MissionModel();
	}

	// SEARCH BAR
	public function index()
	{
		$search = $this->request->getGet('q');

		if ($search)
		{
			$query = '%'.$search.'%';
			$this->model->like('id_vehicule', $query)
						->orLike('id_user', $query)
						->orLike('id_lieu_depart', $query)
						->orLike('id_lieu_arrive', $query)
						->orLike('date_depart', $query)
						->orderBy('id_vehicule');
		}
		else
		{
			$this->model->orderBy('id_vehicule');
		}
		$data['search'] = $search;
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Mission/index', $data);
	}


	// DISPLAY AN ELEMENT
	public function show($id)
	{
		$data['item'] = $this->model->find($id);
		return view('Mission/show', $data);
	}


	// CREATION FORM
	public function create()
	{
		$data['title'] = "Créer Mission";
		return view('Mission/create', $data);
	}


	// INSERT INTO DATABASE
	public function store()
	{
		$data = $this->request->getPost();
		$entity = new Mission();
		$entity->fill($data);

		if (!$this->model->insert($entity))
		{
			return redirect()->back()->with('error', 'Erreur lors de l\'ajout.');
		}
		
		return redirect()->to('/Mission');
	}


	// MODIFICATION FORM
	public function edit($id)
	{
		$data['item'] = $this->model->find($id);
		$data['title'] = "Modifier Mission";
		return view('Mission/edit', $data);
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

		return redirect()->to('/Mission');
	}


	// DELETE AN ELEMENT
	public function delete($id)
	{
		$this->model->delete($id);
		return redirect()->to('/Mission');
	}
}