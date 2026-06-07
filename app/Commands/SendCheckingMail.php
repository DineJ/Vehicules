<?php

namespace App\Commands;

use App\Models\IncidentModel;
use App\Models\SuiviModel;
use App\Models\VehiculeModel;
use App\Models\UserModel;
use CodeIgniter\CLI\BaseCommand;
use Dompdf\Dompdf;

class SendCheckingMail extends BaseCommand
{
	// Command configuration
	protected $group = 'Mail';
	protected $name = 'mail:send-checking';
	protected $description = 'Send checking PDF by email';
	protected $usage = 'mail:send-checking [idIncident]';

	public function run(array $params)
	{
		// Retrieve the incident ID passed as a command argument
		$idIncident = $params[0] ?? null;

		// Stop execution if no incident ID was provided
		if (!$idIncident) {
			log_message('error', 'ID Incident manquant pour mail:send-checking');
			return;
		}

		// Initialize required models
		$incidentModel = new IncidentModel();
		$suiviModel = new SuiviModel();
		$vehiculeModel = new VehiculeModel();
		$userModel = new UserModel();

		// Load the incident
		$incident = $incidentModel->find($idIncident);

		// Retrieve the driver linked to the incident
		$user = $userModel->find($incident->id_user);

		// Stop execution if the incident cannot be found
		if (!$incident) {
			log_message('error', 'Incident introuvable : ' . $idIncident);
			return;
		}

		// Retrieve vehicle information linked to the incident
		$vehicule = $vehiculeModel->find($incident->id_vehicule);

		// Retrieve the latest maintenance/checking details
		$suivi = $suiviModel
			->where('id_incident', $idIncident)
			->orderBy('id', 'DESC')
			->first();

		// Stop execution if no follow-up record exists
		if (!$suivi) {
			log_message('error', 'Suivi introuvable pour incident : ' . $idIncident);
			return;
		}

		// Decode the JSON payload containing the vehicle inspection data
		$description = $suivi->description;

		// Prepare data for the PDF view
		$data = ['vehicule' => $vehicule,'checks' => json_decode($description, true),'driver' => $user->prenom . ' ' . $user->nom];

		// Generate HTML from the PDF template
		$html = view('Pdf/entretien', $data);

		// Configure and generate the PDF document
		$options = new \Dompdf\Options();
		$options->set('isRemoteEnabled', true);
		$options->set('chroot', FCPATH);

		$dompdf = new Dompdf($options);
		$dompdf->loadHtml($html);
		$dompdf->setPaper('A4', 'portrait');
		$dompdf->render();

		// Ensure the temporary PDF directory exists
		$uploadDir = WRITEPATH . 'uploads/';

		if (!is_dir($uploadDir)) {
			mkdir($uploadDir, 0775, true);
		}

		// Save the generated PDF locally
		$pdfPath = $uploadDir . 'controle_vehicule_' . $suivi->id . '.pdf';

		file_put_contents($pdfPath, $dompdf->output());

		// Retrieve email recipients from environment configuration
		$recipients = array_map('trim', explode(',', env('MAIL_TO')));

		// Build and send the email with the PDF attachment
		$email = \Config\Services::email();
		$email->setTo($recipients);
		$email->setSubject('Contrôle régulier du ' . $vehicule->plaque);
		$email->setMailType('html');
		$email->setMessage('Bonjour,<br><br>Veuillez trouver le contrôle véhicule en pièce jointe.<br><br>Cordialement.');
		$email->attach($pdfPath, 'attachment', basename($pdfPath));

		// Log any SMTP or delivery errors
		if (!$email->send()) {
			log_message('error', $email->printDebugger(['headers']));
		}
	}
}