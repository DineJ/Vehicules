<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>
<form method="post" action="<?= site_url('Type_incident/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<!-- Type name -->
	<label>Nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>
	<input type='hidden' id='oldnom' name='oldnom' value='<?= isset($item) ? $item->nom : '' ?>'>

	<!-- Check critical -->
	<label>Critique</label>
	<div>
		<input type='checkbox' id='critique' name='critique' value='1' <?= (isset($item) && $item->critique) ? 'checked' : '' ?>>
		<input type='hidden' id='oldcritique' name='oldcritique' value='<?= (isset($item) && $item->critique) ? 1 : 0 ?>'>
	</div>

	<!-- Redirection button -->
	<a href="<?= site_url('Type_incident/show/'.$item->id) ?>" class="btn btn-secondary mt-3">Retour</a>

	<!-- Sumbit button -->
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

</form>

<script>

	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

	function validateForm()
	{
		let compare = 0;
		let row = 0;

		let nom = document.getElementById('nom').value;
		let oldnom = document.getElementById('oldnom').value;
		row++;

		if (nom == oldnom)
		{
			compare++;
		}

		let critique = (document.getElementById('critique').checked ? 1 : 0 );
		let oldcritique = document.getElementById('oldcritique').value;
		row++;

		if (critique == oldcritique)
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