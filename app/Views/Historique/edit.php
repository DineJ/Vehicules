<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Historique - <?= $title ?></h2>

<form method="post" action="<?= site_url('Historique/update/'.$item->date_dbt) ?>" onsubmit="return validateForm()">

	<label>id_user</label>
	<input type='number' id='id_user' name='id_user' value='<?= isset($item) ? $item->id_user : '' ?>' class='form-control' required>
	<input type='hidden' id='oldid_user' name='oldid_user' value='<?= isset($item) ? $item->id_user : '' ?>'>

	<label>date_fin</label>
	<input type='date' id='date_fin' name='date_fin' value='<?= isset($item) ? $item->date_fin : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_fin' name='olddate_fin' value='<?= isset($item) ? $item->date_fin : '' ?>'>

	<a href="<?= site_url('Historique') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
	function validateForm()
	{
		let compare = 0;
		let row = 0;

		let id_user = document.getElementById('id_user').value;
		let oldid_user = document.getElementById('oldid_user').value;
		row++;
		if (id_user == oldid_user)
		{
			compare++;
		}

		let date_fin = document.getElementById('date_fin').value;
		let olddate_fin = document.getElementById('olddate_fin').value;
		row++;
		if (date_fin == olddate_fin)
		{
			compare++;
		}

		if (compare == row)
		{
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}
</script>

<?= $this->endSection() ?>