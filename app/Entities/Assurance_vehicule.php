<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Assurance_vehicule
 *
 * @property $id_assurance
 * @property $id_vehicule
 */
class Assurance_vehicule extends Entity
{
	protected $casts = [
		'id_assurance' => 'integer',
		'id_vehicule' => 'integer',
	];

	protected $validationRules = [
		'id_assurance' => 'integer|max_length[11]',
		'id_vehicule' => 'integer|max_length[11]',
	];


	public function getidAssurance()
	{
		return $this->attributes['id_assurance'] ?? null;
	}


	public function setidAssurance($idAssurance)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['id_assurance' => 'integer']);

		if (!$validation->run(['id_assurance' => $idAssurance])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'id_assurance': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['id_assurance'] = $idAssurance;
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

}
