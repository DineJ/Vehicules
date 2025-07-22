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
		if (null !== session()->get('user'))
		{
			if (session()->get('user')['admin'])
			{
				return redirect()->to('/Admin');
			}
			else
			{
				return redirect()->to('/User');
			}
		}

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

		$now = date('Y-m-d H:i:s');
		$data['item'] = $user;
		session()->set('user', ['id' => $user->id,'name' => $user->nom,'admin' => $user->admin, 'date' => $now]);
		session()->set('session_start', time());

		db_connect()->table('historique')->insert(['id_user' => $user->id,'date_dbt' => $now,'date_fin' => $now]);

		if ($data['item']->admin)
		{
			return redirect()->to('/Admin');
		}
		else
		{
			return redirect()->to('/User');
		}
	}


	public function logout()
	{
		$userId = session()->get('user')['id'];
		if ($userId)
		{
			$db = db_connect();
			$date_session = session()->get('user')['date'];
			$now = date('Y-m-d H:i:s');

			$db->table('historique')
				->where('id_user', $userId)
				->where('date_dbt', $date_session)
				->update(['date_fin' => $now]);
		}

		session()->destroy();
		return redirect()->to('/');
	}


}