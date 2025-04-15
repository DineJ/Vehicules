<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class User
 *
 * @property $id
 * @property $nom
 * @property $prenom
 * @property $admin
 * @property $telephone
 * @property $mail
 * @property $actif
 */
class User extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'nom' => 'string',
		'prenom' => 'string',
		'admin' => 'integer',
		'telephone' => 'string',
		'mail' => 'string',
		'actif' => 'integer',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'nom' => 'string|max_length[50]',
		'prenom' => 'string|max_length[50]',
		'admin' => 'integer|max_length[1]',
		'telephone' => 'string|max_length[10]',
		'mail' => 'string|max_length[100]',
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

	public function getprenom()
	{
		return $this->attributes['prenom'] ?? null;
	}

	public function setprenom($prenom)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['prenom' => 'string']);

		if (!$validation->run(['prenom' => $prenom])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'prenom': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['prenom'] = $prenom;
		return $this;
	}

	public function getadmin()
	{
		return $this->attributes['admin'] ?? null;
	}

	public function setadmin($admin)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['admin' => 'integer']);

		if (!$validation->run(['admin' => $admin])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'admin': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['admin'] = $admin;
		return $this;
	}

	public function gettelephone()
	{
		return $this->attributes['telephone'] ?? null;
	}

	public function settelephone($telephone)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['telephone' => 'string']);

		if (!$validation->run(['telephone' => $telephone])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'telephone': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['telephone'] = $telephone;
		return $this;
	}

	public function getmail()
	{
		return $this->attributes['mail'] ?? null;
	}

	public function setmail($mail)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['mail' => 'string']);

		if (!$validation->run(['mail' => $mail])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'mail': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['mail'] = $mail;
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
