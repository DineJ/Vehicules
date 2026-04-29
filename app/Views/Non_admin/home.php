<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>


<?php if (!empty($missions))
	{
		$missionCommence = $missions['0']->date_depart == $missions['0']->date_arrivee;
	} ?>

<h2> Espace des conducteurs</h2>

<?php if (isset($missionCommence) && $missionCommence)
{?>
	<div id="hideModal" style="display:block;">
		<?php createSection($missions, 'Mission', 'Non_admin', ['nom_complet' => 'Conducteur', 'plaque' => 'Plaque', 'lieu_depart' => 'Lieu de départ', 'lieu_arrive' => 'Lieu arrivé', 'motif' => 'Motif', 'date_depart' => 'Date départ', 'km_depart' => 'Km départ'], 0, 0); ?>
	</div>

	<form  method="post" action="<?= site_url('Mission/end/'.$missions['0']->id) ?>" onsubmit="return check(<?= $missions['0']->km_depart ?>, 'km_arrive')">

		<div id="hideForm" style="display:none;">
			<!-- Select end KM -->
			<label>Km d'arrivé</label>
			<input type="number" id="km_arrive" name="km_arrive" value="" class="form-control" required>

			<!-- Auto select end date -->
			<input type="hidden" id="date_arrivee" name="date_arrivee" value="<?= date('Y-m-d H:i:s')?>">

			<button type="button" class="btn btn-warning mt-3" onclick="hideDiv(['hideForm', 'hideModal', 'hideButton'])">Retour</button>
			<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
		</div>

			<button type="button" id="hideButton" class="btn btn-primary mt-3" onclick="hideDiv(['hideForm', 'hideModal', 'hideButton']); document.getElementById('km_arrive').focus()">Finir la mission</button>

			<?php if ($missions['0']->km_depart == $missions['0']->km_arrive) // Check is a mission is pending
			{ ?>
				<!-- Create a button to swap return to your previous location-->
				<a href="<?= site_url('Mission/renew/'.$missions['0']->id) ?>" class="btn btn-warning mt-3" >Retour <?= $missions['0']->Surnom ?></a>
			<?php
			} ?>
	</form>
<?php
}
else
{
?>
	<a href="Mission/debut" class="btn btn-warning">Commencer la mission</a>
<?php
}
?>

	<a href="<?= site_url('Incident/declarer') ?>" class="btn btn-danger">Déclarer un incident</a>

<script src="<?= base_url('js/popupModal.js') ?>"></script>
<script src="<?= base_url('js/hideLayout.js') ?>"></script>
<script>
	function check(valueId, idValued)
	{
		const idChecked = document.getElementById(idValued).value;

		if(valueId >= idChecked)
		{
			alert("La valuer est trop basse");
			return false;
		}
	}

</script>
<?= $this->endSection() ?>
