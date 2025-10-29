<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Suivi - <?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/update/'.$item->id) ?>" onsubmit="return validateFormSuivi()">

	<!-- Display all incident into a list -->
	<label for="id_incident">Incident</label>
	<select id="id_incident" name="id_incident" class="form-control" required>
		<?php foreach ($incidents as $i): ?>

			<!-- Match id with a value -->
			<option value="<?= $i->incident_id ?>"<?= (isset($item) && $item->id_incident == $i->incident_id) ? 'selected' : '' ?>>
				<?= 'Vehicule : ' . $i->plaque . ' — Date :  ' . date('d/m/Y', strtotime($i->date_incident)) ?>
			</option>

		<?php endforeach; ?>
		<input type="hidden" id="oldid_incident" name="oldid_incident" value="<?= isset($item) ? $item->id_incident : '' ?>">
	</select>

	<!-- Type date -->
	<label>Date Intervention</label>
	<input type="date" id="date_intervention" name="date_intervention" value="<?= isset($item) ? substr($item->date_intervention, 0, 10) : '' ?>" class="form-control" required>
	<input type="hidden" id="olddate_intervention" name="olddate_intervention" value="<?= isset($item) ? substr($item->date_intervention, 0, 10) : '' ?>">

	<!-- Type a short explication -->
	<label>Description</label>
	<textarea onchange="setUpper(document.getElementById('description'));" id="description" name="description" class="form-control"><?= isset($item) ? $item->description : '' ?></textarea>
	<input type="hidden" id="olddescription" name="olddescription" value="<?= isset($item) ? $item->description : '' ?>">

	<!-- Redirection button -->
	<a href="<?= site_url('Suivi/show/'.$item->id) ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/validateForm.js') ?>"></script>
<script>

	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

</script>

<?= $this->endSection() ?>