<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Assurance</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<tr>
				<td class="td-hidden">Véhicule</td>
				<td data-label="Véhicule"><?= esc(($item->plaque ?? 'Inconnu')) ?></td>
			</tr>

			<!-- Display date_contrat -->
			<tr>
				<td class="td-hidden">Date contrat</td>
				<td data-label="Date contrat"><?= date('d/m/Y', strtotime($item->date_contrat)) ?></td>
			</tr>

		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Assurance/update/'.$item->id) ?>">
		<!-- Redirection button -->
		<a href="<?= site_url('Assurance') ?>" class="btn btn-secondary">Retour</a>

		<!-- Redirection button to edit assurance form -->
		<a href="<?= site_url('Assurance/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
	</form>
</div>

<?= $this->endSection() ?>