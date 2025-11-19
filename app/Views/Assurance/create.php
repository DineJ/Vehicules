<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Assurance/store/') ?>">

	<!-- Display all vehicles into a list -->



	<!-- Type date -->
	<label>Date contrat</label>
	<input type="date" id="date_contrat" name="date_contrat" value="<?= isset($item) ? $item->date_contrat : '' ?>" class="form-control" required>

	<!-- Redirection button -->
	<a href="<?= site_url('Assurance') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<?= $this->endSection() ?>