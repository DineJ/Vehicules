<?php

namespace App\Models;

use CodeIgniter\Model;

class SessionModel extends Model
{
    protected $table = 'historique';
    protected $primaryKey = 'date_dbt';
    protected $returnType = 'App\Entities\Historique';
    protected $allowedFields = ['date_fin'];
}
