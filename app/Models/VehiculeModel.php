<?php

namespace App\Models;

use CodeIgniter\Model;

class VehiculeModel extends Model
{
	protected $table = 'vehicule';
	protected $primaryKey = 'id';
	protected $returnType = 'App\Entities\Vehicule';
	protected $allowedFields = ['plaque', 'marque', 'modele', 'date_achat', 'date_immat', 'ct', 'actif'];
}
