<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\VehiculeModel;
use App\Models\LieuModel;
use App\Models\InfractionModel;
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
		$this->lieuModel = new LieuModel();
		$this->infractionModel = new InfractionModel();
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

		$data['lieu'] = $this->lieuModel
			->select('id, numero, nom_lieu, adresse')
			->where('actif =', 0)
			->get()
			->getResult();

		// Request to get datas
		$data['infraction'] = $this->infractionModel
			->select('infraction.id, vehicule.plaque AS Plaque, CONCAT(user.prenom,  " ", user.nom) AS Conducteur, date_infraction AS Date, points as Points, prix as Prix')
			->join('mission', 'mission.id = infraction.id_mission', 'left')
			->join('vehicule', 'vehicule.id = mission.id_vehicule', 'left')
			->join('user', 'user.id = mission.id_user', 'left')
			->orderBy('date_infraction', 'DESC')
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
