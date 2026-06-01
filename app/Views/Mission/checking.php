<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php vehicle_checking_form("1","block","none","2","Usure des pneus (visuel)",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Usés","Pas usés"], ["oeil.png","pneu_use.png"]) ?>
<?php vehicle_checking_form("2","none","1","3","Pression des pneus (visuel)",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Dégonflés","Gonflés"], ["oeil.png","pneu_degonfle.png"]) ?>
<?php vehicle_checking_form("3","none","2","4","Contrôle des niveaux",["engine_oil" => "Huile moteur","coolant_fluid" => "Liquide refroidissement", "brake_fluid" => "Liquide de frein", "washer_fluid" => "Liquide lave-glace"], ["À remplir","Ok"], ["oeil.png","jauge.png"]) ?>
<?php vehicle_checking_form("4","none","3","5","Contrôle des clignotants",["warning" => "Warning"], ["Éteints","Allumés"], ["clignotants.gif"], 300) ?>
<?php vehicle_checking_form("5","none","4","6","Contrôle plaques",["front_license_plate" => "Plaque d'immatriculation avant", "rear_license_plate" => "Plaque d'immatricualtion arrière"], ["Éteints","Allumés"], ["plaques.gif"], 400) ?>
<?php vehicle_checking_form("6","none","5","7","Contrôle feux arrières",["brake_lights" => "Feux de stop", "reversing_lights" => "Feux de recul"], ["Éteints","Allumés"], ["feux_stop_recul.png"], 400) ?>
<?php vehicle_checking_form("7","none","6","none","Contrôle feux avant",["high_beams" => "Feux de route", "low_beams" => "Feux de croisement"], ["Éteints","Allumés"], ["feux_croisement_route.png"], 400) ?>

<script>
	document.getElementById('checkingForm').addEventListener('submit', function () {
		const data = {};
		document.querySelectorAll('.checking-item').forEach(function (checkbox) {
			const label = checkbox.dataset.label;
			data[label] = checkbox.checked ? 'OK' : 'Défectueux';
		});
		document.getElementById('explication_incident').value = JSON.stringify(data);
	});
</script>

<?= $this->endSection() ?>