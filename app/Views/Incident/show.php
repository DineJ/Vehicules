<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>

		<!-- Display car involved into the incident -->
		<tr>
			<td>Vehicule</td>
			<td><?= $vehicule->plaque ?></td>
		</tr>

		<!-- Display date of the incident -->
		<tr>
			<td>Date Incident</td>
			<td><?= date('d/m/Y H:i:s', strtotime($item->date_incident)) ?></td>
		</tr>

		<!-- Display short explication of the incident -->
		<tr>
			<td>Explication Incident</td>
			<td class="long-text"><?= $item->explication_incident ?></td>
		</tr>

		<!-- Display driver involved in the incident -->
		<tr>
			<td>Conducteur</td>
			<td><?= $utilisateur->prenom . ' ' . $utilisateur->nom ?></td>
		</tr>

		<!-- Display incident type -->
		<tr>
			<td>Type Incident</td>
			<td><?= $type_incident->nom ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>">

		<!-- Redirection button -->
		<a href="<?= site_url('Incident') ?>" class="btn btn-secondary">Retour</a>

		<!-- Redirection button -->
		<a href="<?= site_url('Incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

	</form>
</div>


<?= createSection($suivi, 'Suivi', 'infraction', ['date_intervention' => 'Date intervention', 'description' => 'Description'], 1, 1, $item->id) ?>

<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>
<script src="<?= base_url('js/popupModal.js') ?>"></script>

<?= $this->endSection() ?>
