<?php

namespace App\Models;

use CodeIgniter\Model;

class LieuModel extends Model
{
	protected $table = 'lieu';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Lieu';
	protected $allowedFields = ['nom_lieu', 'code_postal', 'numero', 'adresse', 'actif'];
}
