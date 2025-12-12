<?php

namespace App\Models;

use CodeIgniter\Model;

class MissionModel extends Model
{
	protected $table = 'mission';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Mission';
	protected $allowedFields = ['id_vehicule', 'id_user', 'id_lieu_depart', 'id_lieu_arrive', 'motif', 'date_depart', 'date_arrivee', 'km_depart', 'km_arrive'];
}
