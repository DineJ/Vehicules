<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Lieu - <?= $title ?></h2>

<form method="post" action="<?= site_url('Lieu/store/') ?>">

	<!-- Type nom_lieu -->
	<label>nom_lieu</label>
	<input type="text" onchange="setUpper(document.getElementById('nom_lieu'));" id="nom_lieu" name="nom_lieu" value="<?= isset($item) ? $item->nom_lieu : '' ?>" class="form-control" required>

	<!-- Type code_postal -->
	<label>code_postal</label>
	<input type="text" onchange="setUpper(document.getElementById('code_postal'));" id="code_postal" name="code_postal" value="<?= isset($item) ? $item->code_postal : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>numero</label>
	<input type="number" id="numero" name="numero" value="<?= isset($item) ? $item->numero : '' ?>" class="form-control" required>

	<!-- Type adresse -->
	<label>adresse</label>
	<input type="text" onchange="setUpper(document.getElementById('adresse'));" id="adresse" name="adresse" value="<?= isset($item) ? $item->adresse : '' ?>" class="form-control" required>

	<!-- Check your actif -->
	<label>actif</label>
	<div>
		<input type="checkbox" id="actif" name="actif" value="1" <?= (isset($item) && $item->actif) ? 'checked' : '' ?>>
	</div>

	<!-- Redirection button -->
	<a href="<?= site_url('Lieu') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script>
	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
</script>

<?= $this->endSection() ?>