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

		<!-- Redirection button -->
		<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>

		<!-- Redirection button to edit user form-->
		<a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">

		<!-- Redirection button -->
		<input type="hidden" name="redirect_url" value="<?= current_url(); ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>

<?= createSection($permis, 'Permis', 'user', ['id' => 'Numéro', 'date_permis' => 'Date obtention', 'update_permis' => 'Date expiration', 'type_permis' => 'Catégorie'], 1, 1, $item->id); ?>


<script src="<?= base_url('js/popupModal.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>
