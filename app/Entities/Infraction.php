<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Infraction
 *
 * @property $id
 * @property $id_mission
 * @property $date_infraction
 * @property $commentaire
 * @property $points
 * @property $prix
 * @property $stationnement
 */
class Infraction extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'id_mission' => 'integer',
		'date_infraction' => 'datetime',
		'commentaire' => 'string',
		'points' => 'integer',
		'prix' => 'integer',
		'stationnement' => 'integer',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'id_mission' => 'integer|max_length[11]',
		'date_infraction' => 'valid_date[Y-m-d]',
		'commentaire' => 'string',
		'points' => 'integer|max_length[3]',
		'prix' => 'integer|max_length[5]',
		'stationnement' => 'integer|max_length[1]',
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


	public function getidMission()
	{
		return $this->attributes['id_mission'] ?? null;
	}


	public function setidMission($idMission)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_mission' => 'integer']);

		if (!$validation->run(['id_mission' => $idMission])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_mission': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_mission'] = $idMission;
		return $this;
	}


	public function getdateInfraction()
	{
		return $this->attributes['date_infraction'] ?? null;
	}


	public function setdateInfraction($dateInfraction)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_infraction' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['date_infraction' => $dateInfraction])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_infraction': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_infraction'] = $dateInfraction;
		return $this;
	}


	public function getcommentaire()
	{
		return $this->attributes['commentaire'] ?? null;
	}


	public function setcommentaire($commentaire)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['commentaire' => 'string']);

		if (!$validation->run(['commentaire' => $commentaire])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'commentaire': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['commentaire'] = $commentaire;
		return $this;
	}


	public function getpoints()
	{
		return $this->attributes['points'] ?? null;
	}


	public function setpoints($points)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['points' => 'integer']);

		if (!$validation->run(['points' => $points])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'points': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['points'] = $points;
		return $this;
	}


	public function getprix()
	{
		return $this->attributes['prix'] ?? null;
	}


	public function setprix($prix)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['prix' => 'integer']);

		if (!$validation->run(['prix' => $prix])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'prix': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['prix'] = $prix;
		return $this;
	}


	public function getstationnement()
	{
		return $this->attributes['stationnement'] ?? null;
	}


	public function setstationnement($stationnement)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['stationnement' => 'integer']);

		if (!$validation->run(['stationnement' => $stationnement])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'stationnement': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['stationnement'] = $stationnement;
		return $this;
	}

}
