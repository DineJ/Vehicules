<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Permis/store/') ?>">

        <!-- Select your driver -->
        <input type="hidden"id="id_user" name="id_user" value="<?= esc($userId ?? '') ?>">

	<label>Numéro</label>
	<input type='text' pattern="^[0-9A-Z]{9}$" id='num_permis' name='num_permis' value='<?= isset($item) ? $item->num_permis : '' ?>' class='form-control' required>

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

	<a href="<?= site_url('User/show/'.$userId) ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<?= $this->endSection() ?>
