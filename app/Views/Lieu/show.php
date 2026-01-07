<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Lieu</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display city's name -->
			<tr>
				<td class="td-hidden">Ville</td>
				<td data-label="Ville"><?= $item->nom_lieu ?></td>
			</tr>

			<!-- Display postal code -->
			<tr>
				<td class="td-hidden">Code postal</td>
				<td data-label="Code postal"><?= $item->code_postal ?></td>
			</tr>

			<!-- Display street number -->
			<tr>
				<td class="td-hidden">Numéro</td>
				<td data-label="Numéro"><?= $item->numero ?></td>
			</tr>

			<!-- Display address -->
			<tr>
				<td class="td-hidden">Adresse</td>
				<td data-label="Adresse"><?= $item->adresse ?></td>
			</tr>

			<!-- Display site active or not -->
			<tr>
				<td class="td-hidden">Actif</td>
				<td data-label="Actif"><?= $item->actif ? 'Oui' : 'Non' ?></td>
			</tr>
		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Lieu/update/'.$item->id) ?>">

		<!-- Redirection button to edit user form -->
		<a href="<?= site_url('Lieu/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>
</br>

<!-- Redirection button -->
<a href="<?= site_url('Lieu') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>
