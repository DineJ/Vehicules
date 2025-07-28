<?php

namespace App\Models;

use CodeIgniter\Model;

class Type_incidentModel extends Model
{
    protected $table = 'type_incident';
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Type_incident';
    protected $allowedFields = ['nom', 'critique'];
}
