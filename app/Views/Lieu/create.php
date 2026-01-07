<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Lieu - <?= $title ?></h2>

<form method="post" action="<?= site_url('Lieu/store/') ?>">

	<!-- Type city's name -->
	<label>Ville</label>
	<input type="text" oninput="setUpper(document.getElementById('nom_lieu'));" id="nom_lieu" name="nom_lieu" value="<?= isset($item) ? $item->nom_lieu : '' ?>" class="form-control" required>

	<!-- Type postal code -->
	<label>Code postal</label>
	<input type="text" oninput="setUpper(document.getElementById('code_postal'));" id="code_postal" name="code_postal" value="<?= isset($item) ? $item->code_postal : '' ?>" class="form-control" required>

	<!-- Type street number  -->
	<label>Numéro</label>
	<input type="number" id="numero" name="numero" value="<?= isset($item) ? $item->numero : '' ?>" class="form-control" required>

	<!-- Type address -->
	<label>Adresse</label>
	<input type="text" oninput="setUpper(document.getElementById('adresse'));" id="adresse" name="adresse" value="<?= isset($item) ? $item->adresse : '' ?>" class="form-control" required>

	<!-- Site is active or not -->
	<label>Actif</label>
	<div>
		<input type="checkbox" id="actif" name="actif" value="1" <?= (isset($item) && $item->actif) ? 'checked' : '' ?>>
	</div>

	<!-- Redirection button -->
	<a href="<?= site_url('Lieu') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
