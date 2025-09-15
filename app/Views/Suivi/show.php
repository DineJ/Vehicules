<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Suivi</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display id_incident -->
			<tr>
				<td class="td-hidden">Incident</td>
				<td data-label="id_incident"><?= $incident->plaque . ', ' . substr($incident->date_incident, 0, 10)?></td>
			</tr>

			<!-- Display date_intervention -->
			<tr>
				<td class="td-hidden">Date Intervention</td>
				<td data-label="date_intervention"><?= substr($item->date_intervention, 0, 10) ?></td>
			</tr>

			<!-- Display description -->
			<tr>
				<td class="td-hidden">Description</td>
				<td data-label="description"><?= $item->description ?></td>
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