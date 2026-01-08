<?php

namespace App\Models;

use CodeIgniter\Model;

class InfractionModel extends Model
{
	protected $table = 'infraction';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Infraction';
	protected $allowedFields = ['id_mission', 'date_infraction', 'commentaire', 'points', 'prix', 'stationnement'];
}
