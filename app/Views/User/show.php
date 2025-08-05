<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de User</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display nom -->
			<tr>
				<td class="td-hidden">nom</td>
				<td data-label="nom"><?= $item->nom ?></td>
			</tr>

			<!-- Display prenom -->
			<tr>
				<td class="td-hidden">prenom</td>
				<td data-label="prenom"><?= $item->prenom ?></td>
			</tr>

			<!-- Display admin -->
			<tr>
				<td class="td-hidden">admin</td>
				<td data-label="admin"><?= $item->admin ? 'Oui' : 'Non' ?></td>
			</tr>

			<!-- Display telephone -->
			<tr>
				<td class="td-hidden">telephone</td>
				<td data-label="telephone"><?= $item->telephone ?></td>
			</tr>

			<!-- Display mail -->
			<tr>
				<td class="td-hidden">mail</td>
				<td data-label="mail"><?= $item->mail ?></td>
			</tr>

			<!-- Display actif -->
			<tr>
				<td class="td-hidden">actif</td>
				<td data-label="actif"><?= $item->actif ? 'Oui' : 'Non' ?></td>
			</tr>

			<!-- Display clef_connexion -->
			<tr>
				<td class="td-hidden">clef_connexion</td>
				<td data-label="clef_connexion"><?= $item->clef_connexion ?></td>
			</tr>
		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('User/update/'.$item->id) ?>">

		<!-- Redirection button to edit user form -->
		<a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		<input type="hidden" name="actif" id="actif" value="<?= $item->actif ? 0 : 1 ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>
	</form>
</div>
</br>

<!-- Redirection button -->
<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>