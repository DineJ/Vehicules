<?php

namespace App\Controllers;

use App\Models\IpModel;
use App\Models\UserModel;
use App\Models\VehiculeModel;
use App\Models\LieuModel;
use App\Models\InfractionModel;
use App\Models\MissionModel;
use App\Entities\User;
use CodeIgniter\Controller;

class AdminController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->ipModel = new IpModel();
		// Load the umodel
		$this->model = new UserModel();
		$this->vehiculeModel = new VehiculeModel();
		$this->lieuModel = new LieuModel();
		$this->infractionModel = new InfractionModel();
		$this->missionModel = new MissionModel();
	}

	// Display the admin dashboard
	public function administrator()
	{
		// Redirect to user page if not an admin
		if (null == session()->get('user')['admin'])
		{
			return redirect()->to('/User');
		}

		$data['ip'] = $this->ipModel
			->select('adresse_ip AS IP, nb_echec, id')
			->where('nb_echec >', 2)
			->get()
			->getResult();

		$data['user'] = $this->model
				->select('id, CONCAT(nom, " ", prenom) AS Conducteur, actif')
				->where('actif =', 0)
				->get()
				->getResult();

		$data['vehicule'] = $this->vehiculeModel
			->select('id, plaque AS Plaque, marque AS Marque, modele AS Modèle')
			->where('actif =', 0)
			->get()
			->getResult();

		$data['lieu'] = $this->lieuModel
			->select('id, CONCAT(numero, " ", adresse, " ", nom_lieu, " ", code_postal) AS Adresse')
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

		$data['mission'] = $this->missionModel
			->select('CONCAT(user.nom, " ", user.prenom) AS Conducteur, vehicule.plaque AS Plaque, motif AS Motif, CONCAT(l1.numero, " ", l1.adresse, " ", l1.nom_lieu, " ", l1.code_postal) AS Départ, mission.date_depart AS Début, CONCAT(l2.numero, " ", l2.adresse, " ", l2.nom_lieu, " ", l2.code_postal) AS Arrivé, mission.date_arrivee AS Fin')
			->join('user', 'user.id = mission.id_user', 'left')
			->join('vehicule', 'vehicule.id = mission.id_vehicule', 'left')
			->join('lieu l1', 'l1.id = mission.id_lieu_depart', 'left')
			->join('lieu l2', 'l2.id = mission.id_lieu_arrive', 'left')
			->orderBy('mission.date_depart', 'DESC')
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
