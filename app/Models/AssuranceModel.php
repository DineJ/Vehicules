<?php

namespace App\Models;

use CodeIgniter\Model;

class AssuranceModel extends Model
{
	protected $table = 'assurance';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Assurance';
	protected $allowedFields = ['date_contrat'];
}
