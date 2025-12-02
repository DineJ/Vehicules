<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Assurance/update/'.$item->id) ?>" onsubmit="return validateFormAssurance()">

	<!-- Assurance -->
	<label>Assurance</label>
	<input type="text" oninput="setUpper(document.getElementById('nom_assurance'));" id="nom_assurance" name="assurance" value="<?= isset($item) ? esc(($item->nom_assurance)) : '' ?>" class="form-control" required>
	<input type="hidden" id="oldnom_assurance" name="oldnom_assurance" value="<?= isset($item) ? esc(($item->nom_assurance)) : '' ?>">

	<!-- Type date -->
	<label>Date  contrat</label>
	<input type="date" id="date_contrat" name="date_contrat" value="<?= isset($item) ? esc(substr($item->date_contrat, 0, 10)) : '' ?>" class="form-control" required>
	<input type="hidden" id="olddate_contrat" name="olddate_contrat" value="<?= isset($item) ? substr($item->date_contrat, 0, 10) : '' ?>">


	<!-- Redirection button -->
	<a href="<?= site_url('Assurance/show/'.$item->id) ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script src="<?= base_url('js/validateForm.js') ?>"></script>
<script src="<?= base_url('js/main.js') ?>"></script>
<?= $this->endSection() ?>