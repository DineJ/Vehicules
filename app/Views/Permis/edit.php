<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/update/'.$item->id_user) ?>" onsubmit="return validateFormPermis()">

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


	<a href="<?= site_url('User/show/'.$item->id_user) ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script src="<?= base_url('js/validateForm.js') ?>"></script>
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

</script>

<?= $this->endSection() ?>
