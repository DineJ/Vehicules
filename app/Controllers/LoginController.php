<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Entities\User;
use CodeIgniter\Controller;

class LoginController extends Controller
{
	protected $model;

	public function __construct()
	{
		$this->model = new UserModel();
	}


	// LOGIN PAGE
	public function login()
	{
		$data['title'] = "Page de connexion";
		return view('Login/login', $data);
	}


	// LOGIN REDIRECTION
	public function log()
	{
		$password = $this->request->getPost('clef_connexion');
		$md5 = md5($password);
		$user = $this->model->where('clef_connexion', $md5)->first();

		if (!isset($user))
		{
			session()->setFlashdata('error', 'Mot de passe éronné');
			return redirect()->to('/');
		}

		$data['item'] = $user;
		session()->set('user', ['id' => $user->id,'name' => $user->nom,'admin' => $user->admin]);
		if ($data['item']->admin)
		{
			return redirect()->to('/Admin');
		}

		return redirect()->to('/User');
	}

}