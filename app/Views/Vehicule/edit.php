<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Vehicule - <?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<!-- Type plaque -->
	<label>plaque</label>
	<input type="text" onchange="setUpper(document.getElementById('plaque'));" id="plaque" name="plaque" value="<?= esc(isset($item) ? $item->plaque : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldplaque" name="oldplaque" value="<?= esc(isset($item) ? $item->plaque : '', 'attr') ?>">

	<!-- Type marque -->
	<label>marque</label>
	<input type="text" onchange="setUpper(document.getElementById('marque'));" id="marque" name="marque" value="<?= esc(isset($item) ? $item->marque : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldmarque" name="oldmarque" value="<?= esc(isset($item) ? $item->marque : '', 'attr') ?>">

	<!-- Type modele -->
	<label>modele</label>
	<input type="text" onchange="setUpper(document.getElementById('modele'));" id="modele" name="modele" value="<?= esc(isset($item) ? $item->modele : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldmodele" name="oldmodele" value="<?= esc(isset($item) ? $item->modele : '', 'attr') ?>">

	<!-- Type date -->
	<label>date_achat</label>
	<input type="date" id="date_achat" name="date_achat" value="<?= esc(isset($item) ? $item->date_achat : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="olddate_achat" name="olddate_achat" value="<?= esc(isset($item) ? $item->date_achat : '', 'attr') ?>">

	<!-- Type date -->
	<label>date_immat</label>
	<input type="date" id="date_immat" name="date_immat" value="<?= esc(isset($item) ? $item->date_immat : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="olddate_immat" name="olddate_immat" value="<?= esc(isset($item) ? $item->date_immat : '', 'attr') ?>">

	<!-- Type date -->
	<label>ct</label>
	<input type="date" id="ct" name="ct" value="<?= esc(isset($item) ? $item->ct : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldct" name="oldct" value="<?= esc(isset($item) ? $item->ct : '', 'attr') ?>">

	<!-- Check your actif -->
	<label>actif</label>
	<div>
		<input type="checkbox" id="actif" name="actif" value="1" <?= esc((isset($item) && $item->actif) ? 'checked' : '', 'attr') ?>>
	</div>
	<input type="hidden" id="oldactif" name="oldactif" value="<?= esc(isset($item) ? $item->actif : '', 'attr') ?>">

	<!-- Redirection button -->
	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
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

		// Count
		let compare = 0;
		let row = 0;

		// Get values
		let plaque = document.getElementById('plaque').value;
		let oldplaque = document.getElementById('oldplaque').value;
		row++;

		// Check values 
		if (plaque == oldplaque)
		{
			compare++;
		}

		// Get values
		let marque = document.getElementById('marque').value;
		let oldmarque = document.getElementById('oldmarque').value;
		row++;

		// Check values 
		if (marque == oldmarque)
		{
			compare++;
		}

		// Get values
		let modele = document.getElementById('modele').value;
		let oldmodele = document.getElementById('oldmodele').value;
		row++;

		// Check values 
		if (modele == oldmodele)
		{
			compare++;
		}

		// Get values
		let date_achat = document.getElementById('date_achat').value;
		let olddate_achat = document.getElementById('olddate_achat').value;
		row++;

		// Check values 
		if (date_achat == olddate_achat)
		{
			compare++;
		}

		// Get values
		let date_immat = document.getElementById('date_immat').value;
		let olddate_immat = document.getElementById('olddate_immat').value;
		row++;

		// Check values 
		if (date_immat == olddate_immat)
		{
			compare++;
		}

		// Get values
		let ct = document.getElementById('ct').value;
		let oldct = document.getElementById('oldct').value;
		row++;

		// Check values 
		if (ct == oldct)
		{
			compare++;
		}

		// Get values
		let actif = (document.getElementById('actif').checked ? 1 : 0 );
		let oldactif = document.getElementById('oldactif').value;
		row++;

		// Check values 
		if (actif == oldactif)
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