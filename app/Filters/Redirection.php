<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Redirection implements FilterInterface
{
	public function before(RequestInterface $request, $arguments = null)
	{
		// Arg given by Routes.php
		$role = $arguments[0] ?? null;
		// Get admin datas
		$admin = session()->get('user')['admin'];

		// $admin is an int and $role a string, they must be converted to the same type
		if ($admin)
		{
			$admin = 'admin';
		}
		else
		{
			$admin = 'nonadmin';
		}

		// var_dump($admin);
		// var_dump($role);

		// Check if the user is allowed to be in this page or not
		if ($admin != $role)
		{
			if ($role == 'admin')
			{
				return redirect()->to('/Non_admin');
			}
			else
			{
				return redirect()->to('/Admin');
			}
		}
	}

	public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
	{
		// No post-processing needed
	}
}
?>
