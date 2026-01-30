<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Mission
 *
 * @property $id
 * @property $id_vehicule
 * @property $id_user
 * @property $id_lieu_depart
 * @property $id_lieu_arrive
 * @property $motif
 * @property $date_depart
 * @property $date_arrivee
 * @property $km_depart
 * @property $km_arrive
 */
class Mission extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'id_vehicule' => 'integer',
		'id_user' => 'integer',
		'id_lieu_depart' => 'integer',
		'id_lieu_arrive' => 'integer',
		'motif' => 'string',
		'date_depart' => 'datetime',
		'date_arrivee' => 'datetime',
		'km_depart' => 'integer',
		'km_arrive' => 'integer',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'id_vehicule' => 'integer|max_length[11]',
		'id_user' => 'integer|max_length[11]',
		'id_lieu_depart' => 'integer|max_length[11]',
		'id_lieu_arrive' => 'integer|max_length[11]',
		'motif' => 'string',
		'date_depart' => 'valid_date[Y-m-d H:i:s]',
		'date_arrivee' => 'valid_date[Y-m-d H:i:s]',
		'km_depart' => 'integer|max_length[11]',
		'km_arrive' => 'integer|max_length[11]',
	];


	public function getid()
	{
		return $this->attributes['id'] ?? null;
	}


	public function setid($id)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id' => 'integer']);

		if (!$validation->run(['id' => $id])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id'] = $id;
		return $this;
	}


	public function getidVehicule()
	{
		return $this->attributes['id_vehicule'] ?? null;
	}


	public function setidVehicule($idVehicule)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_vehicule' => 'integer']);

		if (!$validation->run(['id_vehicule' => $idVehicule])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_vehicule': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_vehicule'] = $idVehicule;
		return $this;
	}


	public function getidUser()
	{
		return $this->attributes['id_user'] ?? null;
	}


	public function setidUser($idUser)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_user' => 'integer']);

		if (!$validation->run(['id_user' => $idUser])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_user': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_user'] = $idUser;
		return $this;
	}


	public function getidLieuDepart()
	{
		return $this->attributes['id_lieu_depart'] ?? null;
	}


	public function setidLieuDepart($idLieuDepart)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_lieu_depart' => 'integer']);

		if (!$validation->run(['id_lieu_depart' => $idLieuDepart])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_lieu_depart': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_lieu_depart'] = $idLieuDepart;
		return $this;
	}


	public function getidLieuArrive()
	{
		return $this->attributes['id_lieu_arrive'] ?? null;
	}


	public function setidLieuArrive($idLieuArrive)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_lieu_arrive' => 'integer']);

		if (!$validation->run(['id_lieu_arrive' => $idLieuArrive])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_lieu_arrive': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_lieu_arrive'] = $idLieuArrive;
		return $this;
	}


	public function getmotif()
	{
		return $this->attributes['motif'] ?? null;
	}


	public function setmotif($motif)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['motif' => 'string']);

		if (!$validation->run(['motif' => $motif])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'motif': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['motif'] = $motif;
		return $this;
	}


	public function getdateDepart()
	{
		return $this->attributes['date_depart'] ?? null;
	}


	public function setdateDepart($dateDepart)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_depart' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_depart' => $dateDepart])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_depart': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_depart'] = $dateDepart;
		return $this;
	}


	public function getdateArrivee()
	{
		return $this->attributes['date_arrivee'] ?? null;
	}


	public function setdateArrivee($dateArrivee)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_arrivee' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_arrivee' => $dateArrivee])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_arrivee': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_arrivee'] = $dateArrivee;
		return $this;
	}


	public function getkmDepart()
	{
		return $this->attributes['km_depart'] ?? null;
	}


	public function setkmDepart($kmDepart)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['km_depart' => 'integer']);

		if (!$validation->run(['km_depart' => $kmDepart])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'km_depart': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['km_depart'] = $kmDepart;
		return $this;
	}


	public function getkmArrive()
	{
		return $this->attributes['km_arrive'] ?? null;
	}


	public function setkmArrive($kmArrive)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['km_arrive' => 'integer']);

		if (!$validation->run(['km_arrive' => $kmArrive])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'km_arrive': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['km_arrive'] = $kmArrive;
		return $this;
	}

}
