<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Suivi - <?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/store/') ?>">

	<!-- Type number -->
	<label>id_incident</label>
	<input type="number" id="id_incident" name="id_incident" value="<?= isset($item) ? $item->id_incident : '' ?>" class="form-control" required>

	<!-- Type date -->
	<label>date_intervention</label>
	<input type="date" id="date_intervention" name="date_intervention" value="<?= isset($item) ? $item->date_intervention : '' ?>" class="form-control" required>

	<!-- Type a short explication -->
	<label>description</label>
	<textarea onchange="setUpper(document.getElementById('description'));" id="description" name="description" class="form-control"><?= isset($item) ? $item->description : '' ?></textarea>

	<!-- Redirection button -->
	<a href="<?= site_url('Suivi') ?>" class="btn btn-secondary mt-3">Retour</a>
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