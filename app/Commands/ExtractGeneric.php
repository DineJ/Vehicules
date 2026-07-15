<?php

namespace App\Commands;

use App\Models\MissionModel;
use CodeIgniter\CLI\BaseCommand;

class ExtractGeneric extends BaseCommand
{
	public function run(array $params)
	{
		$missionModel =  new MissionModel();

		// Get the date
		$start = ($params[0] ?? date('Y-m-d', strtotime('-7 days')));
		$end = ($params[1] ?? date('Y-m-d'));

		// Get datas
		$data['items'] = $missionModel
				->select('vehicule.plaque, CONCAT(user.nom, " ", user.prenom) AS nom_complet, mission.motif, mission.date_depart, mission.date_arrivee, l1.surnom AS surnom_depart , l2.surnom AS surnom_arrive, mission.km_depart, mission.km_arrive')
				->join('user', 'user.id = mission.id_user', 'left')
				->join('vehicule', 'vehicule.id = mission.id_vehicule', 'left')
				->join('lieu l1', 'l1.id = mission.id_lieu_depart', 'left')
				->join('lieu l2', 'l2.id = mission.id_lieu_arrive', 'left')
				->where('mission.date_depart >=', $start)
				->where('mission.date_depart <=', $end)
				->orderBy('nom_complet, mission.date_depart', 'DESC')
				->findAll();

		// Generate a dynamic file name.
		$filename = $start . '-extraction.csv';

		// Create the CSV header row.
		$csv = "Conducteur;Date départ;Date arrivée;Plaque;Motif;Lieu départ;KM départ;Lieu arrivée;KM arrivé\n";

		// Loop through all records returned by the query.
		foreach ($data['items'] as $item) {
			$csv .= $item->nom_complet . ';'
				. $item->date_depart . ';'
				. $item->date_arrivee . ';'
				. $item->plaque . ';'
				. $item->motif . ';'
				. $item->surnom_depart . ';'
				. $item->km_depart . ';'
				. $item->surnom_arrive . ';'
				. $item->km_arrive
				. "\n";
		}

		// Return the CSV file as a downloadable response.
		$csvContent = "\xEF\xBB\xBF" . $csv;

		// Retrieve email recipients from environment configuration
		$recipients = array_map('trim', explode(',', env('MAIL_TO')));

		// Build and send the email with the PDF attachment
		$config = config('Email');
		$email = \Config\Services::email();
		$email->setFrom($config->fromEmail, 'Suivi des véhicules');
		$email->setTo($recipients);
		$email->setSubject('Liste des missions du ' . $start . ' au ' . $end);
		$email->setMailType('html');
		$email->setMessage('Bonjour,<br><br>Veuillez trouver la liste des missions.<br><br>Cordialement.');
		// Attach the generated CSV directly from memory. No temporary file is created, so nothing can remain accessible from public/
		$email->attach($csvContent, 'attachment', $filename, 'text/csv');

		// Log any SMTP or delivery errors
		if (!$email->send())
		{
			log_message('error', $email->printDebugger(['headers']));
		}

		return;
	}
	
}
