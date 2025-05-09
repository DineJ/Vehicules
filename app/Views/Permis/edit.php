<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Permis - <?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/update/'.$item->id_user) ?>" onsubmit="return validateForm()">

	<label>num_permis</label>
	<input type='text' onchange="setUpper(document.getElementById('num_permis'));" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' required>
	<input type='hidden' id='oldnum_permis' name='oldnum_permis' value='<?= isset($item) ? $item->num_permis : '' ?>'>

	<label>date_permis</label>
	<input type='date' id='date_permis' name='date_permis' value='<?= isset($item) ? $item->date_permis : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_permis' name='olddate_permis' value='<?= isset($item) ? $item->date_permis : '' ?>'>

	<label>update_permis</label>
	<input type='date' id='update_permis' name='update_permis' value='<?= isset($item) ? $item->update_permis : '' ?>' class='form-control' required>
	<input type='hidden' id='oldupdate_permis' name='oldupdate_permis' value='<?= isset($item) ? $item->update_permis : '' ?>'>

	<label>type_permis</label>
	<div>
		<select id='type_permis' name='type_permis'>
			<option>--Please choose an option--</option>
			<option value=B>B</option>
			<option value=BE>BE</option>
			<option value=C>C</option>
			<option value=C1>C1</option>
			<option value=C1E>C1E</option>
		</select>
	</div>
	<input type='hidden' id='oldtype_permis' name='oldtype_permis' value='<?= isset($item) ? $item->type_permis : '' ?>'>

	<a href="<?= site_url('Permis') ?>" class="btn btn-secondary mt-3">Retour</a>
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

		let num_permis = document.getElementById('num_permis').value;
		let oldnum_permis = document.getElementById('oldnum_permis').value;
		row++;
		if (num_permis == oldnum_permis)
		{
			compare++;
		}

		let date_permis = document.getElementById('date_permis').value;
		let olddate_permis = document.getElementById('olddate_permis').value;
		row++;
		if (date_permis == olddate_permis)
		{
			compare++;
		}

		let update_permis = document.getElementById('update_permis').value;
		let oldupdate_permis = document.getElementById('oldupdate_permis').value;
		row++;
		if (update_permis == oldupdate_permis)
		{
			compare++;
		}

		let type_permis = document.getElementById('type_permis').value;
		let oldtype_permis = document.getElementById('oldtype_permis').value;
		row++;
		if (type_permis == oldtype_permis)
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