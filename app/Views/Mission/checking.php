<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php vehicle_checking_form("un","block","none","deux","Usure des pneus",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Usés","Pas usés"], ["pneu_usé.png"]) ?>
<?php vehicle_checking_form("deux","none","un","none","Pression des pneus",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Usés","Pas usés"], ["pneu_usé.png"]) ?>

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