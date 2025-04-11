<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>User - <?= $title ?></h2>

<form method="post" action="<?= site_url('User/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<label>nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" pattern="^[a-zA-Z]+([\- ]?[a-zA-Z]+)*$" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>
	<input type='hidden' id='oldnom' name='oldnom' value='<?= isset($item) ? $item->nom : '' ?>'>


	<label>prenom</label>
	<input type='text' onchange="setUpper(document.getElementById('prenom'));" pattern="[a-zA-Z]+([\- ]?[a-zA-Z]+)*" id='prenom' name='prenom' value='<?= isset($item) ? $item->prenom : '' ?>' class='form-control' required>
	<input type='hidden' id='oldprenom' name='oldprenom' value='<?= isset($item) ? $item->prenom : '' ?>'>
	
	<label>admin</label>
	<div>
		<input type='checkbox' id='admin' name='admin' value='1' <?= (isset($item) && $item->admin) ? 'checked' : '' ?>>
		<input type='hidden' id='oldadmin' name='oldadmin' value='<?= (isset($item) && $item->admin) ? 1 : 0 ?>'>
	</div>
	
	<label>telephone</label>
	<input type='tel' pattern="[0-9]{10}" id='telephone' name='telephone' value='<?= isset($item) ? $item->telephone : '' ?>' class='form-control' required>
	<input type='hidden' id='oldtelephone' name='oldtelephone' value='<?= isset($item) ? $item->telephone : '' ?>'>
	
	<label>mail</label>
	<input type='email' pattern="^[a-z0-9]+([_\-\.]{1}[a-z0-9]+)*@[a-z]+\.[a-z]{2,3}$" id='mail' name='mail' value='<?= isset($item) ? $item->mail : '' ?>' class='form-control' required>
	<input type='hidden' id='oldmail' name='oldmail' value='<?= isset($item) ? $item->mail : '' ?>'>
	
    <a href="<?= site_url('User') ?>" class="btn btn-secondary mt-3">Retour</a>	
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script>
	function setUpper(element) {
		element.value=element.value.toUpperCase();
	}

	function validateForm() {
		let compare = 0;
		let row = 0;
		let nom = document.getElementById('nom').value;
		let oldnom = document.getElementById('oldnom').value;
		row++;
		if (nom == oldnom) {
			compare++;
		}

		let prenom = document.getElementById('prenom').value;
		let oldprenom = document.getElementById('oldprenom').value;
		row++;
		if (prenom == oldprenom) {
			compare++;
		}

		
		let admin = (document.getElementById('admin').checked ? 1 : 0 );
		let oldadmin = document.getElementById('oldadmin').value;
		row++;
		if (admin == oldadmin) {
			compare++;
		}
		
		let telephone = document.getElementById('telephone').value;
		let oldtelephone = document.getElementById('oldtelephone').value;
		row++;
		if (telephone == oldtelephone) {
			compare++;
		}

		let mail = document.getElementById('mail').value;
		let oldmail = document.getElementById('oldmail').value;
		row++;
		if (mail == oldmail) {
			compare++;
		}

		if (compare == row) {
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}

</script>

<?= $this->endSection() ?>
