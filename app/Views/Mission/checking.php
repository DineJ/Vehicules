<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php vehicle_checking_form("un","block","none","deux","Usure des pneus (visuel)",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Usés","Pas usés"], ["oeil.png","pneu_use.png"]) ?>
<?php vehicle_checking_form("deux","none","un","trois","Pression des pneus (visuel)",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Dégonflés","Gonflés"], ["oeil.png","pneu_degonfle.png"]) ?>
<?php vehicle_checking_form("trois","none","deux","none","Contrôle des niveaux",["engine_oil" => "Huile moteur","coolant_fluid" => "Liquide refroidissement", "brake_fluid" => "Liquide de frein", "washer_fluid" => "Liquide lave-glace"], ["À remplir","Ok"], ["oeil.png","jauge.png"]) ?>

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