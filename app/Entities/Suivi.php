<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Suivi
 *
 * @property $id
 * @property $id_incident
 * @property $date_intervention
 * @property $description
 */
class Suivi extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'id_incident' => 'integer',
		'date_intervention' => 'datetime',
		'description' => 'string',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'id_incident' => 'integer|max_length[11]',
		'date_intervention' => 'valid_date[Y-m-d]',
		'description' => 'string',
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


	public function getidIncident()
	{
		return $this->attributes['id_incident'] ?? null;
	}


	public function setidIncident($idIncident)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_incident' => 'integer']);

		if (!$validation->run(['id_incident' => $idIncident])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_incident': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_incident'] = $idIncident;
		return $this;
	}


	public function getdateIntervention()
	{
		return $this->attributes['date_intervention'] ?? null;
	}


	public function setdateIntervention($dateIntervention)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_intervention' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['date_intervention' => $dateIntervention])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_intervention': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_intervention'] = $dateIntervention;
		return $this;
	}


	public function getdescription()
	{
		return $this->attributes['description'] ?? null;
	}


	public function setdescription($description)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['description' => 'string']);

		if (!$validation->run(['description' => $description])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'description': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['description'] = $description;
		return $this;
	}

}
