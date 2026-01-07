<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Lieu - <?= $title ?></h2>

<form method="post" action="<?= site_url('Lieu/update/'.$item->id) ?>" onsubmit="return validateFormLieuEdit()">

	<!-- Type city's name -->
	<label>Ville</label>
	<input type="text" onchange="setUpper(document.getElementById('nom_lieu'));" id="nom_lieu" name="nom_lieu" value="<?= isset($item) ? $item->nom_lieu : '' ?>" class="form-control" required>
	<input type="hidden" id="oldnom_lieu" name="oldnom_lieu" value="<?= isset($item) ? $item->nom_lieu : '' ?>">

	<!-- Type postal code -->
	<label>Code postal</label>
	<input type="text" onchange="setUpper(document.getElementById('code_postal'));" id="code_postal" name="code_postal" value="<?= isset($item) ? $item->code_postal : '' ?>" class="form-control" required>
	<input type="hidden" id="oldcode_postal" name="oldcode_postal" value="<?= isset($item) ? $item->code_postal : '' ?>">

	<!-- Type street number -->
	<label>Numéro</label>
	<input type="number" id="numero" name="numero" value="<?= isset($item) ? $item->numero : '' ?>" class="form-control" required>
	<input type="hidden" id="oldnumero" name="oldnumero" value="<?= isset($item) ? $item->numero : '' ?>">

	<!-- Type address -->
	<label>Adresse</label>
	<input type="text" onchange="setUpper(document.getElementById('adresse'));" id="adresse" name="adresse" value="<?= isset($item) ? $item->adresse : '' ?>" class="form-control" required>
	<input type="hidden" id="oldadresse" name="oldadresse" value="<?= isset($item) ? $item->adresse : '' ?>">

	<!-- Redirection button -->
	<a href="<?= site_url('Lieu') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>
