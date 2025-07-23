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
		// Load the user model
		$this->model = new UserModel();
	}

	// Display the admin dashboard
	public function administrator()
	{
		// Redirect to user page if not an admin
		if (null == session()->get('user')['admin'])
		{
			return redirect()->to('/User');
		}

		// Load admin view with title
		$data['title'] = "Page d'administration";
		return view('Admin/admin', $data);
	}
}
