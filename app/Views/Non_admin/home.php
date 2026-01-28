<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<?php $missionCommence = $missions['0']->date_depart == $missions['0']->date_arrivee ?>

<h2> Espace des conducteurs</h2>

<?php if ($missionCommence)
{
	createSection($missions, 'Mission', 'Non_admin', ['nom_complet' => 'Conducteur', 'plaque' => 'Plaque', 'lieu_depart' => 'Lieu de départ', 'lieu_arrive' => 'Lieu arrivé', 'motif' => 'Motif', 'date_depart' => 'Date départ', 'km_depart' => 'Km départ'], '0', '0');
}
?>
<br>
<div>
	<a href="<?= $missionCommence  ? 'Mission/end/'.session()->get('user')['id']) : 'Mission/debut' ?>" class="btn btn-warning"> <?= $missionCommence ? 'Finir la mission' : 'Commencer la mission' ?></a>
	<a href="'Incident/declarer" class="btn btn-danger">Déclarer un incident</a>
</div>

<script src="<?= base_url('js/popupModal.js') ?>"></script>
<?= $this->endSection() ?>
