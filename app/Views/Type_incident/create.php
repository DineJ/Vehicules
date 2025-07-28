<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Type_incident - <?= $title ?></h2>

<form method="post" action="<?= site_url('Type_incident/store/') ?>">

	<label>nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>

	<label>critique</label>
	<div>
		<input type='checkbox' id='critique' name='critique' value='1' <?= (isset($item) && $item->critique) ? 'checked' : '' ?>>
	</div>

	<a href="<?= site_url('Type_incident') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>