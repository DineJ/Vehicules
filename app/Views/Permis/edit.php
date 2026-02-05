<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/update/'.$item->num_permis) ?>" onsubmit="return validateFormPermis()">

	<input type="hidden" name="id_user" id="id_user" value="<?= isset($item) ? $item->id_user : -1 ?>">

	<label>Numéro</label>
	<input type='text' pattern="^[0-9]{10}" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' readonly required>

	<label>Date d'obtention</label>
	<input type='date' id='date_permis' name='date_permis' value='<?= isset($item) ? substr($item->date_permis, 0, 10) : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_permis' name='olddate_permis' value='<?= isset($item) ? substr($item->date_permis, 0, 10) : '' ?>'>

	<label>Date d'expiration</label>
	<input type='date' id='update_permis' name='update_permis' value='<?= isset($item) ? substr($item->update_permis, 0, 10) : '' ?>' class='form-control' required>
	<input type='hidden' id='oldupdate_permis' name='oldupdate_permis' value='<?= isset($item) ? substr($item->update_permis, 0, 10) : '' ?>'>

	<label>Catégorie</label>
	<div>
		<select id="type_permis" name="type_permis" class="form-control" required>
			<option value="B" <?= ($item->type_permis === 'B')   ? 'selected' : '' ?>>B</option>
			<option value="BE" <?= ($item->type_permis === 'BE')   ? 'selected' : '' ?>>BE</option>
			<option value="C" <?= ($item->type_permis === 'C')   ? 'selected' : '' ?>>C</option>
			<option value="C1" <?= ($item->type_permis === 'C1')   ? 'selected' : '' ?>>C1</option>
			<option value="C1E" <?= ($item->type_permis === 'C1E')   ? 'selected' : '' ?>>C1E</option>
		</select>
	</div>
	<input type='hidden' id='oldtype_permis' name='oldtype_permis' value='<?= isset($item) ? $item->type_permis : '' ?>'>


	<a href="<?= site_url('User/show/'.$item->id_user) ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>
