<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/store/') ?>">

	<input type="hidden" name="id_user" id="id_user" value="<?= isset($id_user) ? $id_user : -1 ?>">

	<label>Numéro</label>
	<input type='text' pattern="^[0-9]{10}" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' required>

	<label>Date d'obtention</label>
	<input type='date' id='date_permis' name='date_permis' value='<?= isset($item) ? $item->date_permis : '' ?>' class='form-control' required>

	<label>Date d'expiration</label>
	<input type='date' id='update_permis' name='update_permis' value='<?= isset($item) ? $item->update_permis : '' ?>' class='form-control' required>

	<label>Catégorie</label>
	<div>
		<select id='type_permis' name='type_permis' class="form-control" required>
			<option value="" disabled selected hidden>Choissisez une option</option>
			<option value=B>B</option>
			<option value=BE>BE</option>
			<option value=C>C</option>
			<option value=C1>C1</option>
			<option value=C1E>C1E</option>
		</select>
	</div>

	<a href="<?= site_url('User/show/'.$id_user) ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<?= $this->endSection() ?>
