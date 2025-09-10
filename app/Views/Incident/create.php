<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Incident - <?= $title ?></h2>

<form method="post" id="incidentForm" action="<?= site_url('Incident/store/') ?>">

	<!-- Display all vehicles into a list -->
	<label for="id_vehicule">Vehicule</label>
	<select id="id_vehicule" name="id_vehicule" class="form-control" required>
		<option value="">    Choisir un vehicule    </option>
		<?php foreach ($vehicules as $v): ?>
			<option value="<?= $v->id ?>" <?= (isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
				<?= $v->plaque ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Select a date -->
	<label>Date Incident</label>
	<input type='date' id='date_incident' name='date_incident' value='<?= isset($item) ? $item->date_incident : '' ?>' class='form-control' required>

	<!-- Type a short explication -->
	<label>Explication Incident</label>
	<textarea onchange="setUpper(document.getElementById('explication_incident'));" id='explication_incident' name='explication_incident' class='form-control'><?= isset($item) ? $item->explication_incident : '' ?></textarea>

	</br>

	<!-- Display all drivers into a list -->
	<label for="id_user">Conducteur</label>
	<select id="id_user" name="id_user" class="form-control" required>
		<option value="">    Choisir un conducteur    </option>
		<?php foreach ($utilisateurs as $u): ?>
			<option value="<?= $u->id ?>"
				<?= ((isset($item) && $item->id_user == $u->id) || (!empty($selectedUserId) && $selectedUserId == $u->id)) ? 'selected' : '' ?>>
				<?= $u->prenom . ' ' . $u->nom ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Display all incident types in a list -->
	<div class="mb-3">
		<label for="id_type_incident">Type incident</label>
		<div class="input-group">
			<select id="id_type_incident" name="id_type_incident" class="form-control" required>
				<option value="">    Choisir un type d'incident    </option>
				<?php foreach ($types_incident as $ti): ?>
				<option value="<?= $ti->id ?>"
					<?= ((isset($item) && $item->id_type_incident == $ti->id) || (!empty($selectedTypeIncident) && $selectedTypeIncident == $ti->id)) ? 'selected' : '' ?>>
					<?= $ti->nom ?>
				</option>
		<?php endforeach; ?>
			</select>

			<!-- Redirection button to create incident type form-->
			<a href="<?= site_url('Type_incident/create/?from=incident') ?>" class="btn btn-purple" title="Ajouter un type">+</a>
		</div>
	</div>

	<!-- Redirection button -->
	<a href="<?= (!empty($selectedUserId)) ? site_url('User/show/'.$selectedUserId) : site_url('Incident') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<script>

	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

	window.addEventListener("DOMContentLoaded", () =>
	{
		// Fields to save
		const fields = ["id_vehicule", "date_incident", "explication_incident", "id_user", "id_type_incident" ];

		// Display saved datas
		fields.forEach(id =>
		{
			const value = localStorage.getItem(id);
			if (value)
			{
				document.getElementById(id).value = value;
			}
		});

		// Save automatically
		fields.forEach(id =>
		{
			const el = document.getElementById(id);
			el.addEventListener("input", () =>
			{
				localStorage.setItem(id, el.value);
			});
			el.addEventListener("change", () =>
			{
				localStorage.setItem(id, el.value);
			});
		});

		// Delete datas after submit
		const form = document.getElementById("incidentForm");
		form.addEventListener("submit", () =>
		{
			fields.forEach(id => localStorage.removeItem(id));
		});
	});
</script>

<?= $this->endSection() ?>