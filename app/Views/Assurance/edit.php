<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Assurance/update/'.$item->id) ?>" onsubmit="return validateFormAssurance()">

	<!-- Vehicule -->
	<label>Véhicule</label>
	<input type="text" id="vehicule" name="vehicule" value="<?= isset($item) ? esc(($item->plaque)) : '' ?>" class="form-control" readonly>

	<!-- Type date -->
	<label>Date  contrat</label>
	<input type="date" id="date_contrat" name="date_contrat" value="<?= isset($item) ? esc(substr($item->date_contrat, 0, 10)) : '' ?>" class="form-control" required>
	<input type="hidden" id="olddate_contrat" name="olddate_contrat" value="<?= isset($item) ? substr($item->date_contrat, 0, 10) : '' ?>">


	<!-- Redirection button -->
	<a href="<?= site_url('Assurance/show/'.$item->id) ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>