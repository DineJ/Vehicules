<?php

namespace App\Models;

use CodeIgniter\Model;

class PermisModel extends Model
{
    protected $table = 'permis';
    protected $useAutoIncrement = false;
    protected $primaryKey = 'num_permis';
    protected $returnType = 'App\Entities\Permis';
    protected $allowedFields = ['id_user','num_permis', 'date_permis', 'update_permis', 'type_permis'];
    
}
