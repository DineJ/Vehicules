<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Infraction - <?= $title ?></h2>

<form method="post" action="<?= site_url('Infraction/update/'.$item->id) ?>" onsubmit="return validateFormInfractionEdit()">

	<!-- Choose your mission -->
	<label>Mission</label>
	<input type="number" id="id_mission" name="id_mission" value="<?= isset($item) ? $item->id_mission : '' ?>" class="form-control" required>
	<input type="hidden" id="oldid_mission" name="oldid_mission" value="<?= isset($item) ? $item->id_mission : '' ?>">

	<!-- Choose your date -->
	<label>Date infraction</label>
	<input type="date" id="date_infraction" name="date_infraction" value="<?= isset($item) ? substr($item->date_infraction, 0, 10) : '' ?>" class="form-control" required>
	<input type="hidden" id="olddate_infraction" name="olddate_infraction" value="<?= isset($item) ? $item->date_infraction : '' ?>">

	<!-- Type a short explication -->
	<label>Commentaire</label>
	<textarea oninput="setUpper(document.getElementById('commentaire'));" id="commentaire" name="commentaire" class="form-control"><?= isset($item) ? $item->commentaire : '' ?></textarea>
	<input type="hidden" id="oldcommentaire" name="oldcommentaire" value="<?= isset($item) ? $item->commentaire : '' ?>">

	<!-- Type how many points did you lose-->
	<label>Points</label>
	<input type="number" id="points" name="points" min="0" max="6" step="1" value="<?= isset($item) ? $item->points : '' ?>" class="form-control" required>
	<input type="hidden" id="oldpoints" name="oldpoints" value="<?= isset($item) ? $item->points : '' ?>">

	<!-- Type how much it cost -->
	<label>Prix</label>
	<input type="number" id="prix" name="prix" value="<?= isset($item) ? $item->prix : '' ?>" class="form-control" required>
	<input type="hidden" id="oldprix" name="oldprix" value="<?= isset($item) ? $item->prix : '' ?>">

	<!-- Your ticket was a parking ticket or not -->
	<label>Stationnement</label>
	<div>
		<input type="checkbox" id="stationnement" name="stationnement" value="1" <?= (isset($item) && $item->stationnement) ? 'checked' : '' ?>>
	</div>
	<input type="hidden" id="oldstationnement" name="oldstationnement" value="<?= isset($item) ? $item->stationnement : '' ?>">

	<!-- Redirection button -->
	<a href="<?= site_url('Infraction') ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>

<?= $this->endSection() ?>
