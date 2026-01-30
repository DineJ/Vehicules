<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/store/') ?>">

	<!-- Display all incident into a list -->
	<label for="id_incident">Incident</label>
	<select id="id_incident" name="id_incident" class="form-control" required>
		<?php foreach ($incidents as $i): ?>

			<!-- Match id with a value -->
			<option value="<?= $i->incident_id ?>"<?= (isset($modal_incident_id) && $modal_incident_id == $i->incident_id) ? 'selected' : '' ?>>
				<?= 'Vehicule : ' . $i->plaque . ' — Date : ' . date('d/m/Y', strtotime($i->date_incident)) ?>
			</option>

		<?php endforeach; ?>
	</select>

	<!-- Select date -->
	<label>Date Intervention</label>
	<input type="date" id="date_intervention" name="date_intervention" value="<?= isset($item) ? $item->date_intervention : '' ?>" class="form-control" required>

	<!-- Type a short explication -->
	<label>Description</label>
	<textarea oninput="setUpper(document.getElementById('description'));" id="description" name="description" class="form-control" required><?= isset($item) ? $item->description : '' ?></textarea>

	<!-- Redirection button -->
	<a href="<?= site_url('Suivi') ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

</form>

<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
