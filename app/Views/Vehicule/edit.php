<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>" onsubmit="return validateFormPermis()">

	<!-- Type plaque -->
	<label>Plaque</label>
	<input type="text" oninput="setUpper(document.getElementById('plaque'));" id="plaque" name="plaque" value="<?= esc(isset($item) ? $item->plaque : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldplaque" name="oldplaque" value="<?= esc(isset($item) ? $item->plaque : '', 'attr') ?>">

	<!-- Type marque -->
	<label>Marque</label>
	<input type="text" oninput="setUpper(document.getElementById('marque'));" id="marque" name="marque" value="<?= esc(isset($item) ? $item->marque : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldmarque" name="oldmarque" value="<?= esc(isset($item) ? $item->marque : '', 'attr') ?>">

	<!-- Type modele -->
	<label>Modele</label>
	<input type="text" oninput="setUpper(document.getElementById('modele'));" id="modele" name="modele" value="<?= esc(isset($item) ? $item->modele : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldmodele" name="oldmodele" value="<?= esc(isset($item) ? $item->modele : '', 'attr') ?>">

	<!-- Type date -->
	<label>Date achat</label>
	<input type="date" id="date_achat" name="date_achat" value="<?= esc(isset($item) ? substr($item->date_achat, 0, 10) : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="olddate_achat" name="olddate_achat" value="<?= esc(isset($item) ? substr($item->date_achat, 0, 10) : '', 'attr') ?>">

	<!-- Type date -->
	<label>Date immat</label>
	<input type="date" id="date_immat" name="date_immat" value="<?= esc(isset($item) ? substr($item->date_immat, 0, 10) : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="olddate_immat" name="olddate_immat" value="<?= esc(isset($item) ? substr($item->date_immat, 0, 10) : '', 'attr') ?>">

	<!-- Type date -->
	<label>CT</label>
	<input type="date" id="ct" name="ct" value="<?= esc(isset($item) ? substr($item->ct, 0, 10) : '', 'attr') ?>" class="form-control" required>
	<input type="hidden" id="oldct" name="oldct" value="<?= esc(isset($item) ? substr($item->ct, 0, 10) : '', 'attr') ?>">


	<!-- Redirection button -->
	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>