<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Suivi - <?= $title ?></h2>

<form method="post" action="<?= site_url('Suivi/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<!-- Display all incident into a list -->
	<label for="id_incident">Incident</label>
	<select id="id_incident" name="id_incident" class="form-control" required>
		<?php foreach ($incidents as $i): ?>
			<option value="<?= $i->incident_id ?>"<?= (isset($item) && $item->id_incident == $i->incident_id) ? 'selected' : '' ?>>
				<?= $i->plaque . ', ' . date('m/d/Y', strtotime($i->date_incident)) ?>
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
	<a href="<?= site_url('Suivi') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script>
	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

	function validateForm()
	{

		// Count
		let compare = 0;
		let row = 0;

		// Get values
		let id_incident = document.getElementById('id_incident').value;
		let oldid_incident = document.getElementById('oldid_incident').value;
		row++;

		// Check values 
		if (id_incident == oldid_incident)
		{
			compare++;
		}

		// Get values
		let date_intervention = document.getElementById('date_intervention').value;
		let olddate_intervention = document.getElementById('olddate_intervention').value;
		row++;

		// Check values 
		if (date_intervention == olddate_intervention)
		{
			compare++;
		}

		// Get values
		let description = document.getElementById('description').value;
		let olddescription = document.getElementById('olddescription').value;
		row++;

		// Check values 
		if (description == olddescription)
		{
			compare++;
		}

		// Check counts
		if (compare == row)
		{
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}
</script>

<?= $this->endSection() ?>