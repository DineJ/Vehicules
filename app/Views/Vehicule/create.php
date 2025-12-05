<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Vehicule/store/') ?>">

	<!-- Type plaque -->
	<label>Plaque</label>
	<input type="text" oninput="setUpper(document.getElementById('plaque'));" pattern="^[a-zA-Z]{2}[\s\-]*[0-9]{3}[\s\-]*[a-zA-Z]{2}$" id="plaque" name="plaque" value="<?= esc(isset($item) ? $item->plaque : '', 'attr') ?>" class="form-control" required>

	<!-- Type marque -->
	<label>Marque</label>
	<input type="text" oninput="setUpper(document.getElementById('marque'));" id="marque" name="marque" value="<?= esc(isset($item) ? $item->marque : '', 'attr') ?>" class="form-control" required>

	<!-- Type modele -->
	<label>Modele</label>
	<input type="text" oninput="setUpper(document.getElementById('modele'));" id="modele" name="modele" value="<?= esc(isset($item) ? $item->modele : '', 'attr') ?>" class="form-control" required>

	<!-- Type date -->
	<label>Date achat</label>
	<input type="date" id="date_achat" name="date_achat" value="<?= esc(isset($item) ? $item->date_achat : '', 'attr') ?>" class="form-control" required>

	<!-- Type date -->
	<label>Date immat</label>
	<input type="date" id="date_immat" name="date_immat" value="<?= esc(isset($item) ? $item->date_immat : '', 'attr') ?>" class="form-control" required>

	<!-- Type date -->
	<label>CT</label>
	<input type="date" id="ct" name="ct" value="<?= esc(isset($item) ? $item->ct : '', 'attr') ?>" class="form-control" required>

	<!-- Redirection button -->
	<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
