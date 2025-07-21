<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\Controller;

class AdminController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new UserModel();
	}


	// ADMIN PAGE
	public function administrator()
	{
		if (null == session()->get('user')['admin'])
		{
			return redirect()->to('/User');
		}

		$data['title'] = "Page d'administration";
		return view('Admin/admin', $data);
	}
}