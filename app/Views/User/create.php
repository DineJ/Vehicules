<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>User - <?= $title ?></h2>

<form method="post" action="<?= site_url('User/store/') ?>">

	<label>nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" pattern="^[a-zA-Z]+([\- ]?[a-zA-Z]+)*$" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>

	<label>prenom</label>
	<input type='text' onchange="setUpper(document.getElementById('prenom'));" pattern="[a-zA-Z]+([\- ]?[a-zA-Z]+)*" id='prenom' name='prenom' value='<?= isset($item) ? $item->prenom : '' ?>' class='form-control' required>

	<label>mot de passe</label>
	<input type="password" pattern="[a-zA-Z0-9]{16,32}" id="clef_connexion" name="clef_connexion" class="form-control" minlength="16" maxlength="32" placeholder="Mot de passe entre 16 et 32 caracteres" required>

	<label>admin</label>
	<div>
		<input type='checkbox' id='admin' name='admin' value='1' <?= (isset($item) && $item->admin) ? 'checked' : '' ?>>
	</div>

	<label>telephone</label>
	<input type='tel' pattern="[0-9]{10}" id='telephone' name='telephone' value='<?= isset($item) ? $item->telephone : '' ?>' class='form-control' required>

	<label>mail</label>
	<input type='email' pattern="^[a-zA-Z0-9]+([_\-\.]{1}[a-zA-Z0-9]+)*@[a-zA-Z]+\.[a-zA-Z]{2,3}$" id='mail' name='mail' value='<?= isset($item) ? $item->mail : '' ?>' class='form-control' required>

	<a href="<?= site_url('User') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>
