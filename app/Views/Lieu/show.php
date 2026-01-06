<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Lieu</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display nom_lieu -->
			<tr>
				<td class="td-hidden">nom_lieu</td>
				<td data-label="nom_lieu"><?= $item->nom_lieu ?></td>
			</tr>

			<!-- Display code_postal -->
			<tr>
				<td class="td-hidden">code_postal</td>
				<td data-label="code_postal"><?= $item->code_postal ?></td>
			</tr>

			<!-- Display numero -->
			<tr>
				<td class="td-hidden">numero</td>
				<td data-label="numero"><?= $item->numero ?></td>
			</tr>

			<!-- Display adresse -->
			<tr>
				<td class="td-hidden">adresse</td>
				<td data-label="adresse"><?= $item->adresse ?></td>
			</tr>

			<!-- Display actif -->
			<tr>
				<td class="td-hidden">actif</td>
				<td data-label="actif"><?= $item->actif ? 'Oui' : 'Non' ?></td>
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