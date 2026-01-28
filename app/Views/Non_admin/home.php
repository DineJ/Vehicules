<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>
<?php $missionCommence = $mission->date_depart == $mission->date_arrivee ?>

<h2> Espace des conducteurs</h2>

<div>
	<a href="<?= $missionCommence  ? 'Mission/fin' : 'Mission/debut' ?>" class="btn btn-warning"> <?= $missionCommence ? 'Finir la mission' : 'Commencer la mission' ?></a>
	<a href="'Incident/declarer" class="btn btn-danger">Déclarer un incident</a>
</div>

<?php if ($missionCommence)
{
	createSection($missions, 'Mission', 'Non_admin', ['nom_complet' => 'Conducteur', 'plaque' => 'Plaque', 'lieu_depart' => 'Lieu de départ', 'lieu_arrive' => 'Lieu arrivé', 'motif' => 'Motif', 'date_depart' => 'Date départ', 'km_depart' => 'Km départ'], '0', '1');
}
?>

<script src="<?= base_url('js/popupModal.js') ?>"></script>
<?= $this->endSection() ?>
