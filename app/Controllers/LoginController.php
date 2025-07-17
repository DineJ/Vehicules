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


	// FORMULAIRE DE CRÉATION
	public function create()
	{
		$data['title'] = "Créer User";
		return view('User/create', $data);
	}


	public function login()
	{
		$data['title'] = "Page de connexion";
		return view('Login/login', $data);
	}


	// Login test
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
		if ($data['item']->admin)
		{
			return redirect()->to('/User/create');
		}

		return redirect()->to('/User');
	}

}