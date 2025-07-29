<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Vehicule</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>plaque</td>
			<td><?= $item->plaque ?></td>
		</tr>
		<tr>
			<td>marque</td>
			<td><?= $item->marque ?></td>
		</tr>
		<tr>
			<td>modele</td>
			<td><?= $item->modele ?></td>
		</tr>
		<tr>
			<td>date_achat</td>
			<td><?= $item->date_achat ?></td>
		</tr>
		<tr>
			<td>date_immat</td>
			<td><?= $item->date_immat ?></td>
		</tr>
		<tr>
			<td>ct</td>
			<td><?= $item->ct ?></td>
		</tr>
		<tr>
			<td>actif</td>
			<td><?= $item->actif ? 'Oui' : 'Non' ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>">
		<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Vehicule/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<?= $this->endSection() ?>