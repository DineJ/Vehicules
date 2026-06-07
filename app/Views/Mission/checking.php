<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<form method="post"	action="<?= site_url('Incident/saveChecking/' . $vehicule->id) ?>" id="checkingForm">
	<input type="hidden" name="explication_incident" id="explication_incident">

	<?php vehicle_checking_form('1','block','none','2','Usure des pneus (visuel)',['front_tires_wear' => 'État pneux avants','rear_tires_wear' => 'État pneux arrières'], ['Usés','Pas usés'], ['oeil.png','pneu_use.png']); ?>
	<?php vehicle_checking_form('2','none','1','3','Pression des pneus (visuel)',['front_tires_pressure' => 'Pression pneux avants','rear_tires_pressure' => 'Pression pneux arrières'], ['Dégonflés','Gonflés'], ['oeil.png','pneu_pression.png']); ?>
	<?php vehicle_checking_form('3','none','2','4','Contrôle des niveaux',['engine_oil' => 'Huile moteur','coolant_fluid' => 'Liquide refroidissement', 'brake_fluid' => 'Liquide de frein', 'washer_fluid' => 'Liquide lave-glace'], ['À remplir','Ok'], ['oeil.png','jauge.png']); ?>
	<?php vehicle_checking_form('4','none','3','5','Contrôle des clignotants',['warning' => 'Warning'], ['Éteints','Allumés'], ['clignotants.gif'], 300); ?>
	<?php vehicle_checking_form('5','none','4','6','Contrôle plaques',['front_license_plate' => 'Plaque immatriculation avant', 'rear_license_plate' => 'Plaque immatricualtion arrière'], ['Éteints','Allumés'], ['plaques.gif'], 400); ?>
	<?php vehicle_checking_form('6','none','5','7','Contrôle feux arrières',['brake_lights' => 'Feux de stop', 'reversing_lights' => 'Feux de recul'], ['Éteints','Allumés'], ['feux_stop_recul.png'], 400); ?>
	<?php vehicle_checking_form('7','none','6','none','Contrôle feux avant',['high_beams' => 'Feux de route', 'low_beams' => 'Feux de croisement'], ['Éteints','Allumés'], ['feux_croisement_route.png'], 400); ?>

</form>


<script>
	document.getElementById('checkingForm').addEventListener('submit', function (event) {
		const radios = this.querySelectorAll('input[type="radio"]');
		const groups = [...new Set(Array.from(radios).map(radio => radio.name))];

		for (const group of groups) {
			if (!this.querySelector(`input[name="${group}"]:checked`)) {
				event.preventDefault();
				alert("Veuillez répondre à toutes les questions avant de terminer le contrôle.");
				return;
			}
		}

		const data = {};

		document.querySelectorAll('.checking-item').forEach(function (radio) {
			if (radio.checked === true) {
				data[radio.dataset.label] = {
					etat: radio.value,
					images: radio.dataset.images
						? radio.dataset.images.split(',')
						: []
				};
			}
		});

		document.getElementById('explication_incident').value = JSON.stringify(data);
	});
</script>

<?= $this->endSection() ?>