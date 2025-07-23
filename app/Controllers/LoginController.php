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
		// Load the user model
		$this->model = new UserModel();
	}

	// Show login page
	public function login()
	{
		// Redirect if user is already logged in
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

		// Display login view
		$data['title'] = "Page de connexion";
		return view('Login/login', $data);
	}

	// Handle login attempt
	public function log()
	{
		$ip = $this->request->getIPAddress();
		$db = db_connect();

		// Get IP record if it exists
		$ipRow = $db->table('IP')->where('adresse_ip', $ip)->get()->getRow();

		if ($ipRow)
		{
			// Block login if more than 2 failed attempts
			if ($ipRow->nb_echec > 2)
			{
				session()->setFlashdata('error', 'Votre adresse IP est bloquee');
				return redirect()->to('/Login');
			}

			// Increment failed attempt counter
			$nbFails = $ipRow->nb_echec + 1;
			$db->table('IP')
				->where('adresse_ip', $ip)
				->update(['nb_echec' => $nbFails]);
		}
		else
		{
			// Create a new IP record
			$db->table('IP')->insert([
				'adresse_ip' => $ip,
				'nb_echec' => 1
			]);

			// Retrieve inserted IP record
			$ipRow = $db->table('IP')->where('adresse_ip', $ip)->get()->getRow();
		}

		// Get submitted password and hash it
		$password = $this->request->getPost('clef_connexion');
		$md5 = md5($password);

		// Attempt to find user with matching hashed password
		$user = $this->model->where('clef_connexion', $md5)->first();

		// If no match, redirect with error
		if (!isset($user))
		{
			session()->setFlashdata('error', 'Mot de passe errone');
			return redirect()->to('/Login');
		}

		// Reset failed attempts after successful login
		$db->table('IP')
			->where('adresse_ip', $ip)
			->update(['nb_echec' => 0]);

		$now = date('Y-m-d H:i:s');
		$data['item'] = $user;

		// Store user info in session
		session()->set('user', [
			'id' => $user->id,
			'name' => $user->nom,
			'admin' => $user->admin,
			'date' => $now
		]);
		session()->set('session_start', time());

		// Insert login record in history
		db_connect()->table('historique')->insert([
			'id_user' => $user->id,
			'date_dbt' => $now,
			'date_fin' => $now,
			'id_ip' => $ipRow->id
		]);

		// Redirect to user or admin dashboard
		if ($data['item']->admin)
		{
			return redirect()->to('/Admin');
		}
		else
		{
			return redirect()->to('/User');
		}
	}

	// Handle logout
	public function logout()
	{
		$userId = session()->get('user')['id'];

		if ($userId)
		{
			$db = db_connect();
			$date_session = session()->get('user')['date'];
			$now = date('Y-m-d H:i:s');

			// Update session end time in history
			$db->table('historique')
				->where('id_user', $userId)
				->where('date_dbt', $date_session)
				->update(['date_fin' => $now]);
		}

		// Destroy session and redirect to home
		session()->destroy();
		return redirect()->to('/');
	}
}
