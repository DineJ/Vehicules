<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Assurance
 *
 * @property $id
 * @property $date_contrat
 */
class Assurance extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'date_contrat' => 'datetime',
		'nom_assurance' => 'string',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'date_contrat' => 'valid_date[Y-m-d]',
		'nom_assurance' => 'string',
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


	public function getdateContrat()
	{
		return $this->attributes['date_contrat'] ?? null;
	}


	public function setdateContrat($dateContrat)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_contrat' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['date_contrat' => $dateContrat])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_contrat': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_contrat'] = $dateContrat;
		return $this;
	}

		public function getnomAssurance()
	{
		return $this->attributes['nom_assurance'] ?? null;
	}

	public function setnomAssurance($nomAssurance)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['nom_assurance' => 'string']);

		if (!$validation->run(['nom_assurance' => $nomAssurance])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'nom_assurance': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['nom_assurance'] = $nomAssurance;
		return $this;
	}


}
