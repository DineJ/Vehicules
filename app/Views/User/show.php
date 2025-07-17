<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de User</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>Nom</td>
			<td><?= $item->nom ?></td>
		</tr>
		<tr>
			<td>Prénom</td>
			<td><?= $item->prenom ?></td>
		</tr>
		<tr>
			<td>Admin</td>
			<td><?= $item->admin ? 'Oui' : 'Non' ?></td>
		</tr>
		<tr>
			<td>Téléphone</td>
			<td><?= $item->telephone ?></td>
		</tr>
		<tr>
			<td>Mail</td>
			<td><?= $item->mail ?></td>
		</tr>
		<tr>
			<td>Actif</td>
			<td><?= $item->actif ? 'Oui' : 'Non' ?></td>
		</tr>
	</tbody>
</table>
<a href="<?= site_url('Permis/create/'.$item->id) ?>" class="btn btn-secondary">Permis</a>
<div>
	<form method="post" action="<?= site_url('User/update/'.$item->id) ?>">
		<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<?= $this->endSection() ?>
