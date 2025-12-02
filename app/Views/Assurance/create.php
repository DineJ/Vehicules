<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Assurance/store/') ?>">

	<!-- Type assurance's name -->
	<label>Assurance</label>
	<input oninput="setUpper(document.getElementById('nom_assurance'));" id="nom_assurance" name="nom_assurance" class="form-control"><?= isset($item) ? esc($item->nom_assurance) : '' ?></textarea>

	<!-- Type date -->
	<label>Date contrat</label>
	<input type="date" id="date_contrat" name="date_contrat" value="<?= isset($item) ? esc($plaque->date_contrat) : '' ?>" class="form-control" required>

	<!-- Redirection button -->
	<a href="<?= site_url('Assurance') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
