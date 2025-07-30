<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/update/'.$item->id_user) ?>" onsubmit="return validateForm()">

	<input type="hidden" name="id_user" id="id_user" value="<?= isset($item) ? $item->id_user : -1 ?>">

	<label>Numéro</label>
	<input type='text' pattern="^[0-9]{10}" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' required>
	<input type='hidden' id='oldnum_permis' name='oldnum_permis' value='<?= isset($item) ? $item->num_permis : '' ?>'>

	<label>Date d'obtention</label>
	<input type='date' id='date_permis' name='date_permis' value='<?= isset($item) ? substr($item->date_permis, 0, 10) : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_permis' name='olddate_permis' value='<?= isset($item) ? substr($item->date_permis, 0, 10) : '' ?>'>

	<label>Date d'expiration</label>
	<input type='date' id='update_permis' name='update_permis' value='<?= isset($item) ? substr($item->update_permis, 0, 10) : '' ?>' class='form-control' required>
	<input type='hidden' id='oldupdate_permis' name='oldupdate_permis' value='<?= isset($item) ? substr($item->update_permis, 0, 10) : '' ?>'>

	<label>Catégorie</label>
	<div>
		<select id="type_permis" name="type_permis" required>
			<option value="B">B</option>
			<option value="BE">BE</option>
			<option value="C">C</option>
			<option value="C1">C1</option>
			<option value="C1E">C1E</option>
		</select>
	</div>
	<input type='hidden' id='oldtype_permis' name='oldtype_permis' value='<?= isset($item) ? $item->type_permis : '' ?>'>


	<a href="<?= previous_url() ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	window.addEventListener('DOMContentLoaded', function ()
	{
		const oldValue = document.getElementById('oldtype_permis').value;
		const select = document.getElementById('type_permis');

		if (oldValue)
		{
		  select.value = oldValue;
		}
	}
	);

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
