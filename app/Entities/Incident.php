<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Incident
 *
 * @property $id
 * @property $id_vehicule
 * @property $date_incident
 * @property $explication_incident
 * @property $id_user
 * @property $id_type_incident
 */
class Incident extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'id_vehicule' => 'integer',
        'date_incident' => 'datetime',
        'explication_incident' => 'string',
        'id_user' => 'integer',
        'id_type_incident' => 'integer',
    ];

    protected $validationRules = [
        'id' => 'integer|max_length[11]',
        'id_vehicule' => 'integer|max_length[11]',
        'date_incident' => 'valid_date[Y-m-d]',
        'explication_incident' => 'string',
        'id_user' => 'integer|max_length[11]',
        'id_type_incident' => 'integer|max_length[11]',
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

	public function getdateIncident()
	{
		return $this->attributes['date_incident'] ?? null;
	}

	public function setdateIncident($dateIncident)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_incident' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['date_incident' => $dateIncident])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_incident': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_incident'] = $dateIncident;
		return $this;
	}

	public function getexplicationIncident()
	{
		return $this->attributes['explication_incident'] ?? null;
	}

	public function setexplicationIncident($explicationIncident)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['explication_incident' => 'string']);

		if (!$validation->run(['explication_incident' => $explicationIncident])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'explication_incident': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['explication_incident'] = $explicationIncident;
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

	public function getidTypeIncident()
	{
		return $this->attributes['id_type_incident'] ?? null;
	}

	public function setidTypeIncident($idTypeIncident)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_type_incident' => 'integer']);

		if (!$validation->run(['id_type_incident' => $idTypeIncident])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_type_incident': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_type_incident'] = $idTypeIncident;
		return $this;
	}
}
