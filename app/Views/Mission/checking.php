<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<?php
	$checks = [
		'front_tires'     => 'Pneus avant',
		'rear_tires'      => 'Pneus arrière',
		'engine_oil'      => 'Huile moteur',
		'front_indicator' => 'Clignotant avant',
		'rear_indicator'  => 'Clignotant arrière',
		'brake_fluid'     => 'Liquide de frein',
		'coolant'         => 'Refroidissement',
		'fuel'            => 'Essence',
		'washer_fluid'    => 'Lave-glace',
		'wipers'          => 'Essuie-glace',
		'battery'         => 'Batterie',
		'oil_leak'        => 'Vérifier fuite huile'
	];
?>

<h1>Contrôle de routine du <?= esc($vehicule->plaque) ?></h1>

<form method="post"	action="<?= site_url('Incident/saveChecking/' . $vehicule->id) ?>" id="checkingForm">

	<input type="hidden" name="explication_incident" id="explication_incident">
	<table class="table table-bordered align-middle">
		<thead>
			<tr>
				<th>Point de contrôle</th>
				<th class="text-center">OK</th>
			</tr>
		</thead>

		<tbody>
			<?php foreach ($checks as $key => $label): ?>
				<tr>
					<td><?= esc($label) ?></td>
					<td class="text-center">
						<input type="checkbox" class="form-check-input checking-item" id="<?= esc($key) ?>"	data-label="<?= esc($label) ?>">
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<a href="<?= site_url('Mission/debut') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Valider le contrôle</button>

</form>

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