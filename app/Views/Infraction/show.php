<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Infraction</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display your mission -->
			<tr>
				<td class="td-hidden">Trajet</td>
				<td data-label="Trajet"><?= $item->id_mission ?></td>
			</tr>

			<!-- Display the date -->
			<tr>
				<td class="td-hidden">Date infraction</td>
				<td data-label="Date infraction"><?= $item->date_infraction ?></td>
			</tr>

			<!-- Display the short explication -->
			<tr>
				<td class="td-hidden">Commentaire</td>
				<td data-label="Commentaire"><?= $item->commentaire ?></td>
			</tr>

			<!-- Display how many points you lost on the license -->
			<tr>
				<td class="td-hidden">Points</td>
				<td data-label="Points"><?= $item->points ?></td>
			</tr>

			<!-- Display how much did it cost -->
			<tr>
				<td class="td-hidden">Prix</td>
				<td data-label="Prix"><?= $item->prix ?></td>
			</tr>

			<!-- Display if you get a parking ticket -->
			<tr>
				<td class="td-hidden">Stationnement</td>
				<td data-label="Stationnement"><?= $item->stationnement ? 'Oui' : 'Non' ?></td>
			</tr>
		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Infraction/update/'.$item->id) ?>">

		<!-- Redirection button -->
		<a href="<?= site_url('Infraction') ?>" class="btn btn-secondary">Retour</a>

		<!-- Redirection button to edit infraction form -->
		<a href="<?= site_url('Infraction/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

	</form>
</div>

<?= $this->endSection() ?>
