<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de l'utilisateur</h2>

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

<div>

	<form method="post" action="<?= site_url('User/update/'.$item->id) ?>">

		<a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<div style="margin-left: 3rem; margin-top: 1.5rem; width: 85%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">

	<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
		<h6 style="margin: 0; color: #6f42c1;">↳ Permis</h6>

		<?php if (!isset($permis)) { ?>
		<a href="<?= site_url('Permis/create/'.$item->id) ?>" class="btn btn-success">Ajouter</a>
	</div>
		<table class="table table-striped table-bordered">
			<tbody>
				<tr>
					<td>Pas de permis enregistrer</td>
				</tr>
	<?php
	}
	else
	{
	?>
	<a href="<?= site_url('Permis/edit/' . $permis->id_user) ?>" class="btn btn-warning">Modifer</a>
</div>

	<table class="table table-striped table-bordered">
		<tbody>
			<tr>
				<td>Numéro</td>
				<td><?= $permis->num_permis ?></td>
			</tr>
			<tr>
				<td>Date d'obtention</td>
				<td><?= substr($permis->date_permis, 0, 10) ?></td>
			</tr>
			<tr>
				<td>Date d'expiration</td>
				<td><?= substr($permis->update_permis, 0, 10) ?></td>
			</tr>
			<tr>
				<td>Catégorie</td>
				<td><?= $permis->type_permis ?></td>
			</tr>

	<?php
	}
	?>
		</tbody>
	</table>
</div>

</br>

<a href="<?= previous_url() ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>