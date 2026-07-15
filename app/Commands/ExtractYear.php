<?php

namespace App\Commands;
use ExactractGeneric;
use DateTime;

class ExtractYear extends ExtractGeneric
{
		// Command configuration
	protected $group = 'Mail';
	protected $name = 'mail:send-year';
	protected $description = 'Send yearly missions CSV by email';
	protected $usage = 'mail:send-year ["YYYY"]';

	public function run(array $params)
	{
		$date = new DateTime(($params[0] ?? date('Y')));
		$dateParams[] = (clone $date)->modify('first day of january')->format('Y-m-d');
		$dateParams[] = (clone $date)->modify('last day of december')->format('Y-m-d');

		return parent::run($dateParams);
	}
}