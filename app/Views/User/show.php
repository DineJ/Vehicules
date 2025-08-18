<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de l'utilisateur</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>
			<!-- Display name -->
			<tr>
				<td class="td-hidden">Nom</td>
				<td data-label="Nom"><?= $item->nom ?></td>
			</tr>

			<!-- Display first name -->
			<tr>
				<td class="td-hidden">Prénom</td>
				<td data-label="Prénom"><?= $item->prenom ?></td>
			</tr>

			<!-- Display admin privilege -->
			<tr>
				<td class="td-hidden">Admin</td>
				<td data-label="Admin"><?= $item->admin ? 'Oui' : 'Non' ?></td>
			</tr>

			<!-- Display phone number -->
			<tr>
				<td class="td-hidden">Téléphone</td>
				<td data-label="Téléphone"><?= $item->telephone ?></td>
			</tr>

			<!-- Display email -->
			<tr>
				<td class="td-hidden">Mail</td>
				<td data-label="Mail"><?= $item->mail ?></td>
			</tr>

			<!-- Display if an account is disabled or not -->
			<tr>
				<td class="td-hidden">Actif</td>
				<td data-label="Actif"><?= $item->actif ? 'Oui' : 'Non' ?></td>
			</tr>
		</tbody>
	</table>
</div>

<div>
	<form method="post" action="<?= site_url('User/update/'.$item->id) ?>">

		<!-- Redirection button to edit user form-->
		<a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">

		<!-- Redirection button -->
		<input type="hidden" name="redirect_url" value="<?= current_url(); ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<!-- Creation of a section license -->
<div style="margin-left: 3rem; margin-top: 1.5rem; width: 85%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">
	<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
		<h6 style="margin: 0; color: #6f42c1;">↳ Permis</h6>

		<!-- Test if an user has a license or not -->
		<?php if (!isset($permis)) { ?>

		<!-- Redirection button to create license form-->
		<a href="<?= site_url('Permis/create/'.$item->id) ?>" class="btn btn-success">Ajouter</a>
	</div>
	<div class="table-responsive">
		<table class="table table-striped table-bordered mt-3">

			<tbody>

				<!-- User has no license yet -->
				<tr>
					<td>Pas de permis enregistrer</td>
				</tr>
	<?php
	}
	else
	{
	?>

	<!-- Redirection button to edit license form -->
	<a href="<?= site_url('Permis/edit/' . $permis->id_user) ?>" class="btn btn-warning">Modifer</a>
</div>


<div class="table-responsive">
	<!-- Display license form -->
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display license number -->
			<tr>
				<td class="td-hidden">Numéro</td>
				<td data-label="Numéro"><?= $permis->num_permis ?></td>
			</tr>

			<!-- Display license issue date -->
			<tr>
				<td class="td-hidden">Date d'obtention</td>
				<td data-label="Date obtention"><?= substr($permis->date_permis, 0, 10) ?></td>
			</tr>

			<!-- Display license expiration date -->
			<tr>
				<td class="td-hidden">Date d'expiration</td>
				<td data-label="Date expiration"><?= substr($permis->update_permis, 0, 10) ?></td>
			</tr>

			<!-- Display license category -->
			<tr>
				<td class="td-hidden">Catégorie</td>
				<td data-label="Catégorie"><?= $permis->type_permis ?></td>
			</tr>

	<?php
	}
	?>
			</tbody>
		</table>
	</div>
</div>

</br>

<!-- Redirection button -->
<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>