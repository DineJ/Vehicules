<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?= $missionCommence = $mission->km_debut == $mission->km_arrive ?>
<h2> Espace des conducteurs</h2>

<div>
	<a href="<?= $missionCommence  ? 'Mission/fin' : 'Mission/debut' ?>" class="btn btn-warning"> <?= $missionCommence ? 'Finir la mission' : 'Commencer la mission' ?></a>
	<a href="'Incident/declarer" class="btn btn-danger">Déclarer un incident</a>
</div>

<?php if (!$missionCommence)
{ ?>
	<div class="table-responsive">
		<table class="table table-striped table-bordered mt-3">

			<!-- Datas name -->
			<thead>
				<tr>
					<th>Conducteur</th>
					<th>Plaque</th>
					<th>Lieu de départ</th>
					<th>Lieu d'arrivé</th>
					<th>Motif</th>
					<th>Date départ</th>
					<th>Kilométrage de départ</th>
				</tr>
			</thead>

			<tbody>
				<!-- Display datas -->
				<tr>
					<td data-label="Conducteur"><?= esc($user->conducteur) ?></td>
					<td data-label="Plaque"><?= esc($vehicule->plaque) ?></td>
					<td class="concatenation" data-label="Lieu de départ"><?= esc($lieu->lieu_d) ?></td>
					<td class="concatenation" data-label="Lieu d'arrivé"><?= esc($lieu->lieu_a) ?></td>
					<td data-label="Motif"><?= esc($mission->motif) ?></td>
					<td data-label="Date départ"><?= esc(date('d/m/Y H:i', strtotime($mission->date_depart))) ?></td>
					<td data-label="Km départ"><?= esc($mission->km_depart) ?></td>
				</tr>
			</tbody>
		</table>
	</div>
<? }
?>
<?= $this->endSection() ?>
