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
		</tbody>
	</table>

	<h4> Utilisateur Bannis </h4>

	<!-- Display banned user -->
	<table class="table table-striped table-bordered mt-3">
		<tbody>
			<?php foreach ($user as $users): ?>
				<!-- Display users -->
				<tr>
					<td data-label="Nom"><?= esc($users->nom) ?></td>
					<td data-label="Prénom"><?= esc($users->prenom) ?></td>
					<td data-label="Action">

						<form method="post" action="<?= site_url('User/update/'.$users->id) ?>">
							<!-- Enabled account button -->
							<input type="hidden" name="actif" id="actif" value="1">

							<!-- Redirection button -->
							<input type="hidden" name="redirect_url" value="<?= current_url(); ?>">
							<button type="submit" class="btn btn-danger btn-sm"> Rétablir utilisateur </button>
						</form>
					</td>
				</tr>
			<?php endforeach; ?>
		<t/body>
	</table>

	<!-- Redirection button -->
	<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour vers utilisateur</a>

</div>

<?= $this->endSection() ?> <!-- End the content section -->