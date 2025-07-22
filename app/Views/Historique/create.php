<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Historique - <?= $title ?></h2>

<form method="post" action="<?= site_url('Historique/store/') ?>">

	<label>id_user</label>
	<input type='number' id='id_user' name='id_user' value='<?= isset($item) ? $item->id_user : '' ?>' class='form-control' required>

	<label>date_fin</label>
	<input type='date' id='date_fin' name='date_fin' value='<?= isset($item) ? $item->date_fin : '' ?>' class='form-control' required>

	<a href="<?= site_url('Historique') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>