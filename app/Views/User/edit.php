<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>User - <?= $title ?></h2>

<form method="post" action="<?= site_url('User/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<!-- Type name -->
	<label>Nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" pattern="^[a-zA-Z]+([\- ]?[a-zA-Z]+)*$" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>
	<input type='hidden' id='oldnom' name='oldnom' value='<?= isset($item) ? $item->nom : '' ?>'>

	<!-- Type first name -->
	<label>Prénom</label>
	<input type='text' onchange="setUpper(document.getElementById('prenom'));" pattern="[a-zA-Z]+([\- ]?[a-zA-Z]+)*" id='prenom' name='prenom' value='<?= isset($item) ? $item->prenom : '' ?>' class='form-control' required>
	<input type='hidden' id='oldprenom' name='oldprenom' value='<?= isset($item) ? $item->prenom : '' ?>'>

	<!-- Type password -->
	<label>Mot de passe</label>
	<input type="password" pattern="[a-zA-Z0-9]{16,32}" id="clef_connexion" name="clef_connexion" class="form-control" minlength="16" maxlength="32" placeholder="Mot de passe entre 16 et 32 caracteres">

	<!-- Check admin -->
	<label>Admin</label>
	<div>
		<input type='checkbox' id='admin' name='admin' value='1' <?= (isset($item) && $item->admin) ? 'checked' : '' ?>>
		<input type='hidden' id='oldadmin' name='oldadmin' value='<?= (isset($item) && $item->admin) ? 1 : 0 ?>'>
	</div>
	
	<!-- Type phone number -->
	<label>Téléphone</label>
	<input type='tel' pattern="[0-9]{10}" id='telephone' name='telephone' value='<?= isset($item) ? $item->telephone : '' ?>' class='form-control' required>
	<input type='hidden' id='oldtelephone' name='oldtelephone' value='<?= isset($item) ? $item->telephone : '' ?>'>

	<!-- Type email -->
	<label>Mail</label>
	<input type='email' pattern="^[a-zA-Z0-9]+([_\-\.]{1}[a-zA-Z0-9]+)*@[a-zA-Z]+\.[a-zA-Z]{2,3}$" id='mail' name='mail' value='<?= isset($item) ? $item->mail : '' ?>' class='form-control' required>
	<input type='hidden' id='oldmail' name='oldmail' value='<?= isset($item) ? $item->mail : '' ?>'>

	<!-- Redirection button -->
	<a href="<?= site_url('User') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<!-- Catch and print error -->
<?php if(session()->getFlashdata('error')): ?>
	<div class="alert alert-danger">
		<?= session()->getFlashdata('error') ?>
	</div>
<?php endif; ?>



<script>

	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

	// Check if values are changed or not; returns an error if they are not
	function validateForm()
	{
		// Count
		let compare = 0;
		let row = 0;

		// Get values
		let nom = document.getElementById('nom').value;
		let oldnom = document.getElementById('oldnom').value;
		row++;

		// Check values
		if (nom == oldnom)
		{
			compare++;
		}

		// Get values
		let prenom = document.getElementById('prenom').value;
		let oldprenom = document.getElementById('oldprenom').value;
		row++;

		// Check values
		if (prenom == oldprenom)
		{
			compare++;
		}

		// Get values
		let password = document.getElementById('clef_connexion').value;
		row++;

		// Check values
		if (password.length === 0)
		{
			compare++;
		}

		// Get values
		let admin = (document.getElementById('admin').checked ? 1 : 0 );
		let oldadmin = document.getElementById('oldadmin').value;
		row++;

		// Check values
		if (admin == oldadmin)
		{
			compare++;
		}

		// Get values
		let telephone = document.getElementById('telephone').value;
		let oldtelephone = document.getElementById('oldtelephone').value;
		row++;

		// Check values
		if (telephone == oldtelephone)
		{
			compare++;
		}

		// Get values
		let mail = document.getElementById('mail').value;
		let oldmail = document.getElementById('oldmail').value;
		row++;

		// Check values
		if (mail == oldmail)
		{
			compare++;
		}

		// Check counts
		if (compare == row)
		{
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}
</script>

<?= $this->endSection() ?>
