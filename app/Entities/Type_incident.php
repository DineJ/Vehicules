<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Type_incident
 *
 * @property $id
 * @property $nom
 * @property $critique
 */
class Type_incident extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'nom' => 'string',
        'critique' => 'integer',
    ];

    protected $validationRules = [
        'id' => 'integer|max_length[11]',
        'nom' => 'string|max_length[255]',
        'critique' => 'integer|max_length[1]',
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

	public function getnom()
	{
		return $this->attributes['nom'] ?? null;
	}

	public function setnom($nom)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['nom' => 'string']);

		if (!$validation->run(['nom' => $nom])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'nom': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['nom'] = $nom;
		return $this;
	}

	public function getcritique()
	{
		return $this->attributes['critique'] ?? null;
	}

	public function setcritique($critique)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['critique' => 'integer']);

		if (!$validation->run(['critique' => $critique])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'critique': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['critique'] = $critique;
		return $this;
	}
}
