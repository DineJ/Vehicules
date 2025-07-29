<?php

namespace App\Models;

use CodeIgniter\Model;

class IncidentModel extends Model
{
    protected $table = 'incident';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Incident';
    protected $allowedFields = ['id_vehicule', 'date_incident', 'explication_incident', 'id_user', 'id_type_incident'];
}
