<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Mission - <?= $title ?></h2>

<form method="post" action="<?= site_url('Mission/store/') ?>">

	<!-- Display all vehicules into a list -->
	<label for="id_vehicule">Vehicule</label>
	<select id="id_vehicule" name="id_vehicule" onchange="disabledDefault('id_vehicule')" class="form-control" required>
		<option value=""> Choisir un vehicule </option>
		<?php foreach($vehicules as $v): ?>

			<!-- Match id with a value -->
			<option value="<? $v->id ?>" <?=(isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
				<?= $v->plaque ?>
			</option>
		<?php endforeach; ?>
	</select>


	<!-- Display all drivers into a list -->
	<label for="id_user">Conducteur</label>
	<select id="id_user" name="id_user" onchange="disabledDefault('id_user')" class="form-control" required>
		<option value=""> Choisir un conducteur </option>
		<?php foreach($utilisateurs as $u): ?>

			<!-- Match id with a value -->
			<option value="<? $u->id ?>" <?=(isset($item) && $item->id_user == $u->id) ? 'selected' : '' ?>>
				<?= $u->prenom . ' ' . $u->nom ?>
			</option>
		<?php endforeach; ?>
	</select>


	<!-- Display all starting locations into a list -->
	<label for="id_lieu_depart">Lieu depart</label>
	<select id="id_lieu_depart" name="id_lieu_depart" onchange="disabledDefault('id_lieu_depart')" class="form-control" required>
		<option value=""> Choisir un lieu de depart </option>
		<?php foreach($lieux as $l): ?>

			<!-- Match id with a value -->
			<option value="<? $l->id ?>" <?= (isset($item) && $item->id_lieu_depart == $l->id) ? 'selected' :  '' ?>>
				<?= $l->numero . ' '  . $l->adresse . ' ' . $l->nom_lieu ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Display all ending locations into a list -->
	<label for="id_lieu_arrive">Lieu arrive</label>
	<select id="id_lie_arrive" name="id_lieu_arrive" onchange="disabledDefualt('id_lieu_arrive')" class="form-control" required>
		<option value=""> Choisir un lieu d'arrivé </option>
		<?php foreach($lieux as $l): ?>

			<!-- Match id with a value -->
			<option value="<? $l->id ?>" <?= (isset($item) && $item->id_lieu_arrive == $l->id) ? 'selected' : '' ?>>
				<?= $l->numero . ' ' . $l->adresse . ' ' . $l->nom_lieu ?>
			</option>
		<?php endforeach; ?>
	</select>


	<!-- Select value -->
	<label>motif</label>
	<div>
		<select id="motif" name="motif" class="form-control" required>
			<option value="" disabled selected hidden> Choississez une option </option>
			<option value=B>B</option>
			<option value=BE>BE</option>
			<option value=C>C</option>
			<option value=C1>C1</option>
			<option value=C1E>C1E</option>
		</select>
	</div>

	<!-- Type date -->
	<label>date_depart</label>
	<input type="date" id="date_depart" name="date_depart" value="<?= isset($item) ? $item->date_depart : '' ?>" class="form-control" required>

	<!-- Type date -->
	<label>date_arrivee</label>
	<input type="date" id="date_arrivee" name="date_arrivee" value="<?= isset($item) ? $item->date_arrivee : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>km_depart</label>
	<input type="number" id="km_depart" name="km_depart" value="<?= isset($item) ? $item->km_depart : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>km_arrive</label>
	<input type="number" id="km_arrive" name="km_arrive" value="<?= isset($item) ? $item->km_arrive : '' ?>" class="form-control" required>

	<!-- Redirection button -->
	<a href="<?= site_url('Mission') ?>" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
