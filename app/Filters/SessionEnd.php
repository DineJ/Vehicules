<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SessionEnd implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		$session = session();

		if (!$session->has('user')) {
			return redirect()->to('/Login');
		}

		// Récupère le dernier timestamp d'activité
		$lastActivity = $session->get('last_activity');

		if ($lastActivity && (time() - $lastActivity > 60)) {
			$session->destroy();
			return redirect()->to('/Login');
		}

		// Sinon, met à jour l'activité
		$session->set('last_activity', time());
	}



	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
	}
}
