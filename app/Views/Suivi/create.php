<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Suivi - <?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/store/') ?>">

	<!-- Display all incident into a list -->
	<label for="id_incident">Incident</label>
	<select id="id_incident" name="id_incident" class="form-control" required>
		<option value="">    Choisir un incident    </option>
		<?php foreach ($incidents as $i): ?>

			<!-- Match id with a value -->
			<option value="<?= $i->incident_id ?>"<?= (isset($item) && $item->id_incident == $i->incident_id) ? 'selected' : '' ?>>
				<?= 'Vehicule : ' . $i->plaque . ' — Date : ' . date('d/m/Y', strtotime($i->date_incident)) ?>
			</option>

		<?php endforeach; ?>
	</select>

	<!-- Select date -->
	<label>Date Intervention</label>
	<input type="date" id="date_intervention" name="date_intervention" value="<?= isset($item) ? $item->date_intervention : '' ?>" class="form-control" required>

	<!-- Type a short explication -->
	<label>Description</label>
	<textarea onchange="setUpper(document.getElementById('description'));" id="description" name="description" class="form-control"><?= isset($item) ? $item->description : '' ?></textarea>

	<!-- Redirection button -->
	<a href="<?= site_url('Suivi') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

</form>

<script>
	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
</script>

<?= $this->endSection() ?>