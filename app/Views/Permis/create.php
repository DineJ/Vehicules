<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Permis - <?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/store/') ?>">

	<input type="hidden" name="id_user" id="id_user" value="<?= isset($id_user) ? $id_user : -1 ?>">

	<label>num_permis</label>
	<input type='text' onchange="setUpper(document.getElementById('num_permis'));" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' required>

	<label>date_permis</label>
	<input type='date' id='date_permis' name='date_permis' value='<?= isset($item) ? $item->date_permis : '' ?>' class='form-control' required>

	<label>update_permis</label>
	<input type='date' id='update_permis' name='update_permis' value='<?= isset($item) ? $item->update_permis : '' ?>' class='form-control' required>

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

	<a href="<?= site_url('Permis/') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>
