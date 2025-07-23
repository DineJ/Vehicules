<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class HistoriqueTracker implements FilterInterface
{
	protected $db;
	protected $table;

	public function __construct()
	{
		$this->db = \Config\Database::connect();
		$this->table = $this->db->table('historique');
	}

	public function before(RequestInterface $request, $arguments = null)
	{
		$session = session();

		// Si utilisateur non connecté, on ne fait rien
		if (!$session->has('user'))
		{
			return;
		}

		$user = $session->get('user');
		$userId = $user['id'];
		$now = date('Y-m-d H:i:s');
		$ipAddress = $request->getIPAddress();

		// Met à jour le timestamp d'activité de la session
		$session->set('last_activity', time());

		// Récupère la dernière session historique de l'utilisateur
		$lastSession = $this->table
			->where('id_user', $userId)
			->orderBy('date_dbt', 'DESC')
			->limit(1)
			->get()
			->getRow();


		// Vérifie si la session précédente est trop ancienne
		$lastSessionEnd = strtotime($lastSession->date_fin);
		$timeout = 300; // secondes max d'inactivité

		if (time() - $lastSessionEnd > $timeout)
		{
			// Clôture de la session précédente
			$this->table
				->where('id_user', $userId)
				->where('date_dbt', $lastSession->date_dbt)
				->update([
					'date_fin'  => date('Y-m-d H:i:s', $lastSessionEnd),
				]);
		}
		else
		{
			// Session encore active → mise à jour de date_fin
			$this->table
				->where('id_user', $userId)
				->where('date_dbt', $lastSession->date_dbt)
				->update(['date_fin' => $now]);
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
