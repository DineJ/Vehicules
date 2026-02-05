<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Incident - <?= $title ?></h2>

<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>" onsubmit="return validateFormIncidentEdit()">

	<!-- Display all vehicles into a list -->
	<label for="id_vehicule">Vehicule</label>
		<select id="id_vehicule" name="id_vehicule" class="form-control" required>
		<?php foreach ($vehicules as $v): ?>
			<option value="<?= $v->id ?>" <?= (isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
				<?= esc($v->plaque) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_vehicule' name='oldid_vehicule' value='<?= isset($item) ? $item->id_vehicule : '' ?>'>


	<!-- Select a date -->
	<label>Date Incident</label>
	<input type='datetime-local' id='date_incident' name='date_incident' step="1" max="<?= date('Y-m-d\TH:i:s')?>" value='<?= isset($item) ? esc(date('Y-m-d\TH:i:s', strtotime($item->date_incident))) : '' ?>' class='form-control' required>
	<input type='hidden' id='olddate_incident' name='olddate_incident' value='<?= isset($item) ? esc(date('Y-m-d\TH:i:s', strtotime($item->date_incident))) : '' ?>'>


	<!-- Type a short explication -->
	<label>Explication Incident</label>
	<textarea oninput="setUpper(document.getElementById('explication_incident'));" id='explication_incident' name='explication_incident' class='form-control' required><?= esc($item->explication_incident) ?></textarea>
	<input type='hidden' id='oldexplication_incident' name='oldexplication_incident' value='<?= isset($item) ? $item->explication_incident : '' ?>'>

	</br>

	<!-- Display all drivers into a list -->
	<label for="id_user">Conducteur</label>
	<select id="id_user" name="id_user" class="form-control" required>
		<?php foreach ($utilisateurs as $u): ?>
			<option value="<?= $u->id ?>" <?= (isset($item) && $item->id_user == $u->id) ? 'selected' : '' ?>>
				<?= esc($u->prenom) . ' ' . esc($u->nom) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_user' name='oldid_user' value='<?= isset($item) ? $item->id_user : '' ?>'>


	<!-- Display all incident types in a list -->
	<label for="id_type_incident">Type Incident</label>
	<select id="id_type_incident" name="id_type_incident" class="form-control" required>
		<?php foreach ($types_incident as $ti): ?>
			<option value="<?= $ti->id ?>" <?= (isset($item) && $item->id_type_incident == $ti->id) ? 'selected' : '' ?>>
				<?= esc($ti->nom) ?>
			</option>
		<?php endforeach; ?>
	</select>
	<input type='hidden' id='oldid_type_incident' name='oldid_type_incident' value='<?= isset($item) ? $item->id_type_incident : '' ?>'>


	<!-- Redirection button -->
	<a href="<?= site_url('Incident/show/'.$item->id) ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>
