<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/store/') ?>">

	<!-- Display all incident into a list -->
	<label for="id_incident">Incident</label>
	<select id="id_incident" name="id_incident" onchange="disabledDefault('id_incident')" class="form-control" required>
		<option value=""> Choisir un vehicule </option>

		<?php foreach ($incidents as $i): ?>

		<option value="<?= esc($i->incident_id) ?>" <?= $i->incident_id == $incidentId ? 'selected' : '' ?>>
				<?= 'Vehicule : ' . esc($i->plaque) . ' — Date : ' . esc(date('d/m/Y H:i:s', strtotime($i->date_incident))) ?>
			</option>

		<?php endforeach; ?>

	</select>


	<!-- Select date -->
	<label>Date Intervention</label>
	<input type="date" id="date_intervention" name="date_intervention" value="<?= isset($item) ? esc(date('Y-m-d', strtotime($item->date_intervention))) : '' ?>" class="form-control" required>

	<!-- Type a short explication -->
	<label>Description</label>
	<textarea oninput="setUpper(document.getElementById('description'));" id="description" name="description" class="form-control" required><?= isset($item) ? $item->description : '' ?></textarea>

	<!-- Redirection button -->
	<a href="<?= site_url('Suivi') ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

</form>

<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
