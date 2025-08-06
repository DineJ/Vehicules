<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Ip
 *
 * @property $id
 * @property $adresse_ip
 * @property $nb_echec
 */
class Ip extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'adresse_ip' => 'string',
		'nb_echec' => 'integer',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'adresse_ip' => 'string|max_length[40]',
		'nb_echec' => 'integer|max_length[11]',
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


	public function getadresseIp()
	{
		return $this->attributes['adresse_ip'] ?? null;
	}


	public function setadresseIp($adresseIp)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['adresse_ip' => 'string']);

		if (!$validation->run(['adresse_ip' => $adresseIp])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'adresse_ip': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['adresse_ip'] = $adresseIp;
		return $this;
	}


	public function getnbEchec()
	{
		return $this->attributes['nb_echec'] ?? null;
	}


	public function setnbEchec($nbEchec)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['nb_echec' => 'integer']);

		if (!$validation->run(['nb_echec' => $nbEchec])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'nb_echec': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['nb_echec'] = $nbEchec;
		return $this;
	}

}
