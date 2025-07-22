<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Session
 *
 * @property $id_user
 * @property $date_dbt
 * @property $date_fin
 */
class Session extends Entity
{
    protected $casts = [
        'id_user' => 'integer',
        'date_dbt' => 'datetime',
        'date_fin' => 'datetime',
    ];

    protected $validationRules = [
        'id_user' => 'integer|max_length[11]',
        'date_dbt' => 'valid_date[Y-m-d H:i:s]',
        'date_fin' => 'valid_date[Y-m-d H:i:s]',
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

	public function getdateDbt()
	{
		return $this->attributes['date_dbt'] ?? null;
	}

	public function setdateDbt($dateDbt)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_dbt' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_dbt' => $dateDbt])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_dbt': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_dbt'] = $dateDbt;
		return $this;
	}

	public function getdateFin()
	{
		return $this->attributes['date_fin'] ?? null;
	}

	public function setdateFin($dateFin)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['date_fin' => 'valid_date[Y-m-d H:i:s]']);

		if (!$validation->run(['date_fin' => $dateFin])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'date_fin': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['date_fin'] = $dateFin;
		return $this;
	}
}
