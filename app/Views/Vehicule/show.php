<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Vehicule</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display plaque -->
			<tr>
				<td class="td-hidden">plaque</td>
				<td data-label="plaque"><?= $item->plaque ?></td>
			</tr>

			<!-- Display marque -->
			<tr>
				<td class="td-hidden">marque</td>
				<td data-label="marque"><?= $item->marque ?></td>
			</tr>

			<!-- Display modele -->
			<tr>
				<td class="td-hidden">modele</td>
				<td data-label="modele"><?= $item->modele ?></td>
			</tr>

			<!-- Display date_achat -->
			<tr>
				<td class="td-hidden">date_achat</td>
				<td data-label="date_achat"><?= $item->date_achat ?></td>
			</tr>

			<!-- Display date_immat -->
			<tr>
				<td class="td-hidden">date_immat</td>
				<td data-label="date_immat"><?= $item->date_immat ?></td>
			</tr>

			<!-- Display ct -->
			<tr>
				<td class="td-hidden">ct</td>
				<td data-label="ct"><?= $item->ct ?></td>
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
	<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>">

		<!-- Redirection button to edit user form -->
		<a href="<?= site_url('Vehicule/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>
</br>

<!-- Redirection button -->
<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>