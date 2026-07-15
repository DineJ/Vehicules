<?php

namespace App\Commands;
use ExactractGeneric;
use DateTime;

class ExtractMonth extends ExtractGeneric
{
		// Command configuration
	protected $group = 'Mail';
	protected $name = 'mail:send-month';
	protected $description = 'Send monthly missions CSV by email';
	protected $usage = 'mail:send-month ["YYYY-MM"]';

	public function run(array $params)
	{
		$date = new DateTime(($params[0] ?? date('Y-m')));
		$dateParams[] = (clone $date)->modify('first day of this month')->format('Y-m-d');
		$dateParams[] = (clone $date)->modify('last day of this month')->format('Y-m-d');

		return parent::run($dateParams);
	}
}