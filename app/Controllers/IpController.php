<?php

namespace App\Controllers;

use App\Models\IpModel;
use App\Entities\Ip;
use CodeIgniter\Controller;

class IpController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new IpModel();
	}

	// SEARCH BAR
	public function index()
	{
		
		$data['items'] = $this->model->paginate(5); // Display 5 results
		$data['pager'] = $this->model->pager; // Add pager

		return view('Ip/index', $data);
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

		return redirect()->to('/Ip');
	}
}