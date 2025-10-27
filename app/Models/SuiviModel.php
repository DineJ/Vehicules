<?php

namespace App\Models;

use CodeIgniter\Model;

class SuiviModel extends Model
{
	protected $table = 'suivi';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Suivi';
	protected $allowedFields = ['id_incident', 'date_intervention', 'description'];
}
