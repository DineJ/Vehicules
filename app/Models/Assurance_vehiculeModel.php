<?php

namespace App\Models;

use CodeIgniter\Model;

class Assurance_vehiculeModel extends Model
{
	protected $table = 'assurance_vehicule';
	protected $primaryKey = 'id_vehicule';
	protected $returnType = 'App\Entities\Assurance_vehicule';
	protected $allowedFields = ['id_assurance', 'id_vehicule'];
}
