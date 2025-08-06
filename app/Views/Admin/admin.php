<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->

<!-- Main content -->
<div class="container mt-4">
	<h2>Bienvenue sur l’espace admin</h2>
</div>

<div class="table-responsive">
	<h4> Adresse IP Bannies </h4>

	<!-- Display banned ip -->
	<table class="table table-striped table-bordered mt-3">
		<tbody>
			<?php foreach ($ip as $ips): ?>
				<!-- Display ip adress -->
				<tr>
					<td class="td-hidden">Adresse IP</td>
					<td data-label="Adresse_ip"><?= esc($ips->adresse_ip) ?></td>
					<td data-label="Action">

					<form method="post" action="<?= site_url('Ip/update/'.$ips->id) ?>">
						<!-- Enabled ip button -->
						<input type="hidden" name="nb_echec" id="nb_echec" value="0"?>
						<button type="submit" class="btn btn-danger btn-sm"> <?= $ips->adresse_ip = 'Rétablir IP' ?></button>
					</form>
					</td>
				</tr>
			<?php endforeach; ?>
	</table>
</div>

<?= $this->endSection() ?> <!-- End the content section -->