<? $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2> Début de la mission </h2>

<form method="post" action="<?= site_url('Mission/store/') ?>">

	<div>
		<!-- Display all vehicles -->
		<label for="id_vehicule">Véhicule</label>
		<select id="id_vehicule" name="id_vehicule" onchange="disabledDefault('id_vehicule')" class="form-control trigger" data-target="bloc2" required>
			<option value=""> Choisir votre véhicule </option>
			<?php foreach($vehicules as $v): ?>
				
				<!-- Match id with value -->
				<option value="<?= esc($v->id) ?>" data-fill="<?= $v->km_depart ?>" <?=(isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
					<?= esc($v->plaque) ?>
				</option>

			<?php endforeach; ?>
		</select>
	</div>

	<!-- Disply all starting locations -->
	<div class="bloc" id="bloc2">
		<label for="id_lieu_depart">Lieu départ</label>
		<select id="id_lieu_depart" name="id_lieu_depart" onchange="disabledDefault('id_lieu_depart')" class="form-control trigger" data-target="bloc3" required>
			<option value=""> Choisir un lieu de départ </option>
			<?php foreach($lieux as $ld): ?>

				<!-- Match id with value -->
				<option value="<?= esc($ld->id) ?>" <?=(isset($item) && $item->id_lieu_depart == $ld->id) ? 'selected' : '' ?>>
					<?= esc($ld->numero) . ' ' . esc($ld->adresse) . ' ' . esc($ld->nom_lieu) ?>
				</option>

			<?php endforeach; ?>
		</select>
	</div>

	<!-- Display all ending locations -->
	<div class="bloc" id="bloc3">
		<label for="id_lieu_arrive">Lieu arrivé</label>
		<select id="id_lieu_arrive" name="id_lieu_arrive" onchange="disabledDefault('id_lieu_arrive')" class="form-control trigger" data-target="bloc4" required>
			<option value=""> Choisir un lieu d'arrivé </option>
			<?php foreach($lieux as $la): ?>

				<!-- Match id with value -->
				<option value="<?= esc($la->id) ?>" <?=(isset($item) && $item->id_lieu_arrive == $la->id) ? 'selected' : '' ?>>
					<?= esc($la->numero) . ' ' . esc($la->adresse) . ' ' . esc($la->nom_lieu) ?>
				</option>

			<?php endforeach; ?>
		</select>
	</div>

	<!-- Display all reasons of your mission -->
	<div class="bloc" id="bloc4">
		<label for="motif">Motif</label>
		<select id="motif" name="motif" onchange="disabledDefault('motif')" class="form-control trigger" data-target="bloc5" required>
			<option value=""> Choisir un motif </option>
			<?php foreach($motifs as $m): ?>

				<!-- Match id with value -->
				<option value="<?= esc($m) ?>">
					 <?= esc($m) ?>
				</option>

			<?php endforeach; ?>
		</select>
	</div>

	<!-- Display KM of the vehicle -->
	<div class="bloc" id="bloc5">
		<label>KM véhicule</label>
		<input type="number" id="km_depart" name="km_depart" value="<?= isset($item) && $item->km_depart > 0 ? $item->km_depart : '' ?>" <?= isset($item) && $item->km_depart > 0 ? 'readonly' : ''?> class="form-control" required> 
	</div>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/displayBloc.js') ?>"></script>
<script> prefill('id_vehicule', 'km_depart') </script>

<?= $this->endSection() ?>
