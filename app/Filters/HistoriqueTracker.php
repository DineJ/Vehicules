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
		// Connect to the database and set the 'historique' table
		$this->db = \Config\Database::connect();
		$this->table = $this->db->table('historique');
	}

	public function before(RequestInterface $request, $arguments = null)
	{
		$session = session();

		// Skip if the user is not logged in
		if (!$session->has('user'))
		{
			return;
		}

		$user = $session->get('user');
		$userId = $user['id'];
		$now = date('Y-m-d H:i:s');
		$ipAddress = $request->getIPAddress();

		// Update session activity timestamp
		$session->set('last_activity', time());

		// Get the user's last session history
		$lastSession = $this->table
			->where('id_user', $userId)
			->orderBy('date_dbt', 'DESC')
			->limit(1)
			->get()
			->getRow();

		// Convert previous session end time to timestamp
		$lastSessionEnd = strtotime($lastSession->date_fin);
		$timeout = 300; // max inactivity time in seconds (5 minutes)

		if (time() - $lastSessionEnd > $timeout)
		{
			// Previous session expired → mark it as ended
			$this->table
				->where('id_user', $userId)
				->where('date_dbt', $lastSession->date_dbt)
				->update([
					'date_fin'  => date('Y-m-d H:i:s', $lastSessionEnd),
				]);
		}
		else
		{
			// Session still active → extend end time
			$this->table
				->where('id_user', $userId)
				->where('date_dbt', $lastSession->date_dbt)
				->update(['date_fin' => $now]);
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// No action needed after response
	}
}
