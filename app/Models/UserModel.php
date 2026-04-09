<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
	protected $table = 'user';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\User';
	protected $allowedFields = ['nom', 'prenom', 'admin', 'telephone', 'mail', 'actif', 'clef_connexion'];
}
