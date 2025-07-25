<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Incident - <?= $title ?></h2>

<form method="post" action="<?= site_url('Incident/store/') ?>">

	<label>id_vehicule</label>
	<input type='number' id='id_vehicule' name='id_vehicule' value='<?= isset($item) ? $item->id_vehicule : '' ?>' class='form-control' required>

	<label>date_incident</label>
	<input type='date' id='date_incident' name='date_incident' value='<?= isset($item) ? $item->date_incident : '' ?>' class='form-control' required>

	<label>explication_incident</label>
	<textarea id='explication_incident' name='explication_incident'><?= isset($item) ? $item->explication_incident : '' ?></textarea>
	<label>id_user</label>
	<input type='number' id='id_user' name='id_user' value='<?= isset($item) ? $item->id_user : '' ?>' class='form-control' required>

	<label>id_type_incident</label>
	<input type='number' id='id_type_incident' name='id_type_incident' value='<?= isset($item) ? $item->id_type_incident : '' ?>' class='form-control' required>

	<a href="<?= site_url('Incident') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>