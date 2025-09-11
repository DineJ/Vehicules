<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>

		<!-- Display car invovled into incident -->
		<tr>
			<td>Vehicule</td>
			<td><?= $vehicule->plaque ?></td>
		</tr>

		<!-- Display date of incident -->
		<tr>
			<td>Date Incident</td>
			<td><?= substr($item->date_incident, 0, 10) ?></td>
		</tr>

		<!-- Display short explication of incident -->
		<tr>
			<td>Explication Incident</td>
			<td class="long-text"><?= $item->explication_incident ?></td>
		</tr>

		<!-- Display driver during incident -->
		<tr>
			<td>Conducteur</td>
			<td><?= $utilisateur->prenom . ' ' . $utilisateur->nom ?></td>
		</tr>

		<!-- Display kind of incident -->
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
		<a href="<?= site_url('Incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		
	</form>
</div>

<?= $this->endSection() ?>