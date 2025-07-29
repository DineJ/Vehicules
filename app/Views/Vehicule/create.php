<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Vehicule - <?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/store/') ?>">

	<label>plaque</label>
	<input type='text' onchange="setUpper(document.getElementById('plaque'));" id='plaque' name='plaque' value='<?= isset($item) ? $item->plaque : '' ?>' class='form-control' required>

	<label>marque</label>
	<input type='text' onchange="setUpper(document.getElementById('marque'));" id='marque' name='marque' value='<?= isset($item) ? $item->marque : '' ?>' class='form-control' required>

	<label>modele</label>
	<input type='text' onchange="setUpper(document.getElementById('modele'));" id='modele' name='modele' value='<?= isset($item) ? $item->modele : '' ?>' class='form-control' required>

	<label>date_achat</label>
	<input type='date' id='date_achat' name='date_achat' value='<?= isset($item) ? $item->date_achat : '' ?>' class='form-control' required>

	<label>date_immat</label>
	<input type='date' id='date_immat' name='date_immat' value='<?= isset($item) ? $item->date_immat : '' ?>' class='form-control' required>

	<label>ct</label>
	<input type='date' id='ct' name='ct' value='<?= isset($item) ? $item->ct : '' ?>' class='form-control' required>

	<label>actif</label>
	<div>
		<input type='checkbox' id='actif' name='actif' value='1' <?= (isset($item) && $item->actif) ? 'checked' : '' ?>>
	</div>

	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>