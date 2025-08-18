<?php

namespace App\Models;

use CodeIgniter\Model;

class IpModel extends Model
{
	protected $table = 'Ip';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Ip';
	protected $allowedFields = ['adresse_ip', 'nb_echec'];
}
