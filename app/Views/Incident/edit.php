<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Incident - <?= $title ?></h2>

<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>" onsubmit="return validateForm()">

	<label for="id_vehicule">Vehicule</label>
		<select id="id_vehicule" name="id_vehicule" class="form-control" required>
		<?php foreach ($vehicules as $v): ?>
			<option value="<?= $v->id ?>" <?= (isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
				<?= esc($v->plaque) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_vehicule' name='oldid_vehicule' value='<?= isset($item) ? $item->id_vehicule : '' ?>'>

	<label>Date Incident</label>
	<input type='date' id='date_incident' name='date_incident' value='<?= isset($item) ? substr($item->date_incident, 0, 10) : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_incident' name='olddate_incident' value='<?= isset($item) ? substr($item->date_incident, 0, 10) : '' ?>'>

	<label>Explication Incident</label>
	<textarea onchange="setUpper(document.getElementById('explication_incident'));" id='explication_incident' name='explication_incident' class='form-control'><?= esc($item->explication_incident) ?></textarea>
	<input type='hidden' id='oldexplication_incident' name='oldexplication_incident' value='<?= isset($item) ? $item->explication_incident : '' ?>'>

	</br>

	<label for="id_user">Conducteur</label>
	<select id="id_user" name="id_user" class="form-control" required>
		<?php foreach ($utilisateurs as $u): ?>
			<option value="<?= $u->id ?>" <?= (isset($item) && $item->id_user == $u->id) ? 'selected' : '' ?>>
				<?= esc($u->prenom) . ' ' . esc($u->nom) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_user' name='oldid_user' value='<?= isset($item) ? $item->id_user : '' ?>'>

	<label for="id_type_incident">Type Incident</label>
	<select id="id_type_incident" name="id_type_incident" class="form-control" required>
		<?php foreach ($types_incident as $ti): ?>
			<option value="<?= $ti->id ?>" <?= (isset($item) && $item->id_type_incident == $ti->id) ? 'selected' : '' ?>>
				<?= esc($ti->nom) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_type_incident' name='oldid_type_incident' value='<?= isset($item) ? $item->id_type_incident : '' ?>'>

	<a href="<?= site_url('Incident') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script>
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
	function validateForm()
	{
		let compare = 0;
		let row = 0;

		let id_vehicule = document.getElementById('id_vehicule').value;
		let oldid_vehicule = document.getElementById('oldid_vehicule').value;
		row++;
		if (id_vehicule == oldid_vehicule)
		{
			compare++;
		}

		let date_incident = document.getElementById('date_incident').value;
		let olddate_incident = document.getElementById('olddate_incident').value;
		row++;
		if (date_incident == olddate_incident)
		{
			compare++;
		}

		let explication_incident = document.getElementById('explication_incident').value;
		let oldexplication_incident = document.getElementById('oldexplication_incident').value;
		row++;
		if (explication_incident == oldexplication_incident)
		{
			compare++;
		}

		let id_user = document.getElementById('id_user').value;
		let oldid_user = document.getElementById('oldid_user').value;
		row++;
		if (id_user == oldid_user)
		{
			compare++;
		}

		let id_type_incident = document.getElementById('id_type_incident').value;
		let oldid_type_incident = document.getElementById('oldid_type_incident').value;
		row++;
		if (id_type_incident == oldid_type_incident)
		{
			compare++;
		}

		if (compare == row)
		{
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}
</script>

<?= $this->endSection() ?>