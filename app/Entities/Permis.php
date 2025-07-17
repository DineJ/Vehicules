<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Permis
 *
 * @property $id_user
 * @property $num_permis
 * @property $date_permis
 * @property $update_permis
 * @property $type_permis
 */
class Permis extends Entity
{
    protected $casts = [
        'id_user' => 'integer',
        'num_permis' => 'string',
        'date_permis' => 'datetime',
        'update_permis' => 'datetime',
        'type_permis' => 'string',
    ];

    protected $validationRules = [
        'id_user' => 'integer|max_length[11]',
        'num_permis' => 'string|max_length[12]',
        'date_permis' => 'valid_date[Y-m-d]',
        'update_permis' => 'valid_date[Y-m-d]',
        'type_permis' => 'string',
    ];

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

	public function getnumPermis()
	{
		return $this->attributes['num_permis'] ?? null;
	}

	public function setnumPermis($numPermis)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['num_permis' => 'string']);

		if (!$validation->run(['num_permis' => $numPermis])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'num_permis': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['num_permis'] = $numPermis;
		return $this;
	}

	public function getdatePermis()
	{
		return $this->attributes['date_permis'] ?? null;
	}

	public function setdatePermis($datePermis)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_permis' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['date_permis' => $datePermis])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_permis': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_permis'] = $datePermis;
		return $this;
	}

	public function getupdatePermis()
	{
		return $this->attributes['update_permis'] ?? null;
	}

	public function setupdatePermis($updatePermis)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['update_permis' => 'valid_date[Y-m-d]']);

		if (!$validation->run(['update_permis' => $updatePermis])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'update_permis': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['update_permis'] = $updatePermis;
		return $this;
	}

	public function gettypePermis()
	{
		return $this->attributes['type_permis'] ?? null;
	}

	public function settypePermis($typePermis)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['type_permis' => 'string']);

		if (!$validation->run(['type_permis' => $typePermis])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'type_permis': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['type_permis'] = $typePermis;
		return $this;
	}
}
