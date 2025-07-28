<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Vehicule
 *
 * @property $id
 * @property $plaque
 * @property $marque
 * @property $modele
 * @property $date_achat
 * @property $date_immat
 * @property $ct
 * @property $actif
 */
class Vehicule extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'plaque' => 'string',
        'marque' => 'string',
        'modele' => 'string',
        'date_achat' => 'datetime',
        'date_immat' => 'datetime',
        'ct' => 'datetime',
        'actif' => 'integer',
    ];

    protected $validationRules = [
        'id' => 'integer|max_length[11]',
        'plaque' => 'string|max_length[9]',
        'marque' => 'string|max_length[50]',
        'modele' => 'string|max_length[50]',
        'date_achat' => 'valid_date[Y-m-d H:i:s]',
        'date_immat' => 'valid_date[Y-m-d H:i:s]',
        'ct' => 'valid_date[Y-m-d H:i:s]',
        'actif' => 'integer|max_length[1]',
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

	public function getplaque()
	{
		return $this->attributes['plaque'] ?? null;
	}

	public function setplaque($plaque)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['plaque' => 'string']);

		if (!$validation->run(['plaque' => $plaque])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'plaque': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['plaque'] = $plaque;
		return $this;
	}

	public function getmarque()
	{
		return $this->attributes['marque'] ?? null;
	}

	public function setmarque($marque)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['marque' => 'string']);

		if (!$validation->run(['marque' => $marque])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'marque': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['marque'] = $marque;
		return $this;
	}

	public function getmodele()
	{
		return $this->attributes['modele'] ?? null;
	}

	public function setmodele($modele)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['modele' => 'string']);

		if (!$validation->run(['modele' => $modele])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'modele': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['modele'] = $modele;
		return $this;
	}

	public function getdateAchat()
	{
		return $this->attributes['date_achat'] ?? null;
	}

	public function setdateAchat($dateAchat)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_achat' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_achat' => $dateAchat])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_achat': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_achat'] = $dateAchat;
		return $this;
	}

	public function getdateImmat()
	{
		return $this->attributes['date_immat'] ?? null;
	}

	public function setdateImmat($dateImmat)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_immat' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_immat' => $dateImmat])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_immat': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_immat'] = $dateImmat;
		return $this;
	}

	public function getct()
	{
		return $this->attributes['ct'] ?? null;
	}

	public function setct($ct)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['ct' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['ct' => $ct])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'ct': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['ct'] = $ct;
		return $this;
	}

	public function getactif()
	{
		return $this->attributes['actif'] ?? null;
	}

	public function setactif($actif)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['actif' => 'integer']);

		if (!$validation->run(['actif' => $actif])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'actif': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['actif'] = $actif;
		return $this;
	}
}
