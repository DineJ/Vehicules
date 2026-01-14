<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VehiculeModel;
use App\Entities\User;
use CodeIgniter\Controller;

class AdminController extends Controller
{
	protected $model;

	public function __construct()
	{
		// Load the user model
		$this->model = new UserModel();
		$this->vehiculeModel = new VehiculeModel();
	}

	// Display the admin dashboard
	public function administrator()
	{
		// Redirect to user page if not an admin
		if (null == session()->get('user')['admin'])
		{
			return redirect()->to('/User');
		}

		$db = db_connect();
		$data['ip'] = $db->table('Ip')
						 ->select(['adresse_ip', 'nb_echec', 'id'])
						 ->where('nb_echec >', 2)
						 ->get()
						 ->getResult();

		$data['user'] = $db->table('user')
						   ->select(['id', 'nom', 'prenom', 'actif'])
						   ->where('actif =', 0)
						   ->get()
						   ->getResult();

		$data['vehicule'] = $this->vehiculeModel
			->select('id, plaque, marque, modele')
			->where('actif =', 0)
			->get()
			->getResult();

		// Load admin view with title
		$data['title'] = "Page d'administration";
		return view('Admin/admin', $data);
	}

	public function reactivateIp()
	{
		$ip = $this->request->getPost('adresse_ip');

		if ($ip) {
			$db = db_connect();
			$db->table('Ip')
			->where('adresse_ip', $ip)
			->update(['nb_echec' => 0]);
		}

		return redirect()->to('/Admin/administrator');
	}

}
