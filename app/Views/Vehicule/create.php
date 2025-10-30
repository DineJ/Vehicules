<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Vehicule - <?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/store/') ?>">

	<!-- Type plaque -->
	<label>Plaque</label>
	<input type="text" oninput="setUpper(document.getElementById('plaque'));" pattern="^[a-zA-Z]{2}[\s\-]*[0-9]{3}[\s\-]*[a-zA-Z]{2}$" id="plaque" name="plaque" value="<?= isset($item) ? $item->plaque : '' ?>" class="form-control" required>

	<!-- Type marque -->
	<label>Marque</label>
	<input type="text" oninput="setUpper(document.getElementById('marque'));" id="marque" name="marque" value="<?= isset($item) ? $item->marque : '' ?>" class="form-control" required>

	<!-- Type modele -->
	<label>Modele</label>
	<input type="text" oninput="setUpper(document.getElementById('modele'));" id="modele" name="modele" value="<?= isset($item) ? $item->modele : '' ?>" class="form-control" required>

	<!-- Type date -->
	<label>Date achat</label>
	<input type="date" id="date_achat" name="date_achat" value="<?= isset($item) ? $item->date_achat : '' ?>" class="form-control" required>

	<!-- Type date -->
	<label>Date immat</label>
	<input type="date" id="date_immat" name="date_immat" value="<?= isset($item) ? $item->date_immat : '' ?>" class="form-control" required>

	<!-- Type date -->
	<label>CT</label>
	<input type="date" id="ct" name="ct" value="<?= isset($item) ? $item->ct : '' ?>" class="form-control" required>

	<!-- Redirection button -->
	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>