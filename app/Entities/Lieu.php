<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use CodeIgniter\Validation\ValidationException;

/**
 * Class Lieu
 *
 * @property $id
 * @property $nom_lieu
 * @property $code_postal
 * @property $numero
 * @property $adresse
 * @property $actif
 */
class Lieu extends Entity
{
	protected $casts = [
		'id' => 'integer',
		'nom_lieu' => 'string',
		'code_postal' => 'string',
		'numero' => 'integer',
		'adresse' => 'string',
		'actif' => 'integer',
	];

	protected $validationRules = [
		'id' => 'integer|max_length[11]',
		'nom_lieu' => 'string|max_length[100]',
		'code_postal' => 'string|max_length[5]',
		'numero' => 'integer|max_length[11]',
		'adresse' => 'string|max_length[255]',
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


	public function getnomLieu()
	{
		return $this->attributes['nom_lieu'] ?? null;
	}


	public function setnomLieu($nomLieu)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['nom_lieu' => 'string']);

		if (!$validation->run(['nom_lieu' => $nomLieu])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'nom_lieu': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['nom_lieu'] = $nomLieu;
		return $this;
	}


	public function getcodePostal()
	{
		return $this->attributes['code_postal'] ?? null;
	}


	public function setcodePostal($codePostal)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['code_postal' => 'string']);

		if (!$validation->run(['code_postal' => $codePostal])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'code_postal': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['code_postal'] = $codePostal;
		return $this;
	}


	public function getnumero()
	{
		return $this->attributes['numero'] ?? null;
	}


	public function setnumero($numero)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['numero' => 'integer']);

		if (!$validation->run(['numero' => $numero])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'numero': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['numero'] = $numero;
		return $this;
	}


	public function getadresse()
	{
		return $this->attributes['adresse'] ?? null;
	}


	public function setadresse($adresse)
	{
		$validation = \Config\Services::validation();
		$validation->setRules(['adresse' => 'string']);

		if (!$validation->run(['adresse' => $adresse])) {
			throw new \InvalidArgumentException("❌ Valeur invalide pour 'adresse': " . implode(', ', $validation->getErrors()));
		}

		$this->attributes['adresse'] = $adresse;
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
