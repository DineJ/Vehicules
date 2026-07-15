<?php

namespace App\Commands;
use ExactractGeneric;

class ExtractWeek extends ExtractGeneric
{
	// Command configuration
	protected $group = 'Mail';
	protected $name = 'mail:send-week';
	protected $description = 'Send weekly missions CSV by email';
	protected $usage = 'mail:send-week ["YYYY-MM-DD", "YYYY-MM-DD"]';

	public function run(array $params)
	{
		$dateParams[] =($params[0] ?? date('Y-m-d', strtotime('-7 days')));
		$dateParams[] = ($params[1] ?? date('Y-m-d'));
		
		return parent::run($dateParams);
	}
}
