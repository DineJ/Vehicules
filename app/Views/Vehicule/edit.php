<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Vehicule - <?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<label>plaque</label>
	<input type='text' onchange="setUpper(document.getElementById('plaque'));" id='plaque' name='plaque' value='<?= isset($item) ? $item->plaque : '' ?>' class='form-control' required>
	<input type='hidden' id='oldplaque' name='oldplaque' value='<?= isset($item) ? $item->plaque : '' ?>'>

	<label>marque</label>
	<input type='text' onchange="setUpper(document.getElementById('marque'));" id='marque' name='marque' value='<?= isset($item) ? $item->marque : '' ?>' class='form-control' required>
	<input type='hidden' id='oldmarque' name='oldmarque' value='<?= isset($item) ? $item->marque : '' ?>'>

	<label>modele</label>
	<input type='text' onchange="setUpper(document.getElementById('modele'));" id='modele' name='modele' value='<?= isset($item) ? $item->modele : '' ?>' class='form-control' required>
	<input type='hidden' id='oldmodele' name='oldmodele' value='<?= isset($item) ? $item->modele : '' ?>'>

	<label>date_achat</label>
	<input type='date' id='date_achat' name='date_achat' value='<?= isset($item) ? $item->date_achat : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_achat' name='olddate_achat' value='<?= isset($item) ? $item->date_achat : '' ?>'>

	<label>date_immat</label>
	<input type='date' id='date_immat' name='date_immat' value='<?= isset($item) ? $item->date_immat : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_immat' name='olddate_immat' value='<?= isset($item) ? $item->date_immat : '' ?>'>

	<label>ct</label>
	<input type='date' id='ct' name='ct' value='<?= isset($item) ? $item->ct : '' ?>' class='form-control' required>
	<input type='hidden' id='oldct' name='oldct' value='<?= isset($item) ? $item->ct : '' ?>'>

	<label>actif</label>
	<div>
		<input type='checkbox' id='actif' name='actif' value='1' <?= (isset($item) && $item->actif) ? 'checked' : '' ?>>
	</div>
	<input type='hidden' id='oldactif' name='oldactif' value='<?= isset($item) ? $item->actif : '' ?>'>

	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
	function validateForm()
	{
		let compare = 0;
		let row = 0;

		let plaque = document.getElementById('plaque').value;
		let oldplaque = document.getElementById('oldplaque').value;
		row++;
		if (plaque == oldplaque)
		{
			compare++;
		}

		let marque = document.getElementById('marque').value;
		let oldmarque = document.getElementById('oldmarque').value;
		row++;
		if (marque == oldmarque)
		{
			compare++;
		}

		let modele = document.getElementById('modele').value;
		let oldmodele = document.getElementById('oldmodele').value;
		row++;
		if (modele == oldmodele)
		{
			compare++;
		}

		let date_achat = document.getElementById('date_achat').value;
		let olddate_achat = document.getElementById('olddate_achat').value;
		row++;
		if (date_achat == olddate_achat)
		{
			compare++;
		}

		let date_immat = document.getElementById('date_immat').value;
		let olddate_immat = document.getElementById('olddate_immat').value;
		row++;
		if (date_immat == olddate_immat)
		{
			compare++;
		}

		let ct = document.getElementById('ct').value;
		let oldct = document.getElementById('oldct').value;
		row++;
		if (ct == oldct)
		{
			compare++;
		}

		let actif = (document.getElementById('actif').checked ? 1 : 0 );
		let oldactif = document.getElementById('oldactif').value;
		row++;
		if (actif == oldactif)
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