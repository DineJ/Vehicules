<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
	<h2>Détails de Suivi</h2>
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display id_incident -->
			<tr>
				<td>Incident</td>
				<td data-label="Incident"><?= 'Vehicule : ' . $incident->plaque . ' — Date : ' . date('d/m/Y', strtotime($incident->date_incident))?></td>
			</tr>

			<!-- Display date_intervention -->
			<tr>
				<td>Date Intervention</td>
				<td data-label="Date Intervention"><?= date('d/m/Y', strtotime($item->date_intervention)) ?></td>
			</tr>

			<!-- Display description -->
			<tr>
				<td>Description</td>
				<td class="long-text"><?= $item->description ?></td>
			</tr>

		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Suivi/update/'.$item->id) ?>">

		<!-- Redirection button -->
		<a href="<?= site_url('Suivi') ?>" class="btn btn-secondary">Retour</a>
		<!-- Redirection button to edit user form -->
		<a href="<?= site_url('Suivi/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

	</form>
</div>

<?= $this->endSection() ?>