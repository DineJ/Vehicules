<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Vehicule</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display plaque -->
			<tr>
				<td class="td-hidden">Plaque</td>
				<td data-label="Plaque"><?= $item->plaque ?></td>
			</tr>

			<!-- Display marque -->
			<tr>
				<td class="td-hidden">Marque</td>
				<td data-label="Marque"><?= $item->marque ?></td>
			</tr>

			<!-- Display modele -->
			<tr>
				<td class="td-hidden">Modèle</td>
				<td data-label="Modele"><?= $item->modele ?></td>
			</tr>

			<!-- Display date_achat -->
			<tr>
				<td class="td-hidden">Date achat</td>
				<td data-label="Date achat"><?= date('d/m/Y', strtotime($item->date_achat)) ?></td>
			</tr>

			<!-- Display date_immat -->
			<tr>
				<td class="td-hidden">Date immat</td>
				<td data-label="Date immat"><?= date('d/m/Y', strtotime($item->date_immat)) ?></td>
			</tr>

			<!-- Display ct -->
			<tr>
				<td class="td-hidden">CT</td>
				<td data-label="CT"><?= date('d/m/Y', strtotime($item->ct)) ?></td>
			</tr>

			<!-- Display actif -->
			<tr>
				<td class="td-hidden">Actif</td>
				<td data-label="Actif"><?= $item->actif ? 'Oui' : 'Non' ?></td>
			</tr>

		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>">

		<!-- Redirection button to edit vehicule form -->
		<a href="<?= site_url('Vehicule/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled vehicule button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">

		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<!-- Redirection button -->
<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>