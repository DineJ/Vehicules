<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Infraction - <?= $title ?></h2>

<form method="post" action="<?= site_url('Infraction/store/') ?>">

	<!-- Select your mission -->
	<label>Trajet</label>
	<input class="form-control" name="id_mission" value="<?= esc($missionId ?? '') ?>" readonly>

	<!-- Select the date -->
	<label>Date infraction</label>
	<input type="date" id="date_infraction" name="date_infraction" value="<?= isset($item) ? $item->date_infraction : '' ?>" class="form-control" required>

	<!-- Type a short explication -->
	<label>Commentaire</label>
	<textarea oninput="setUpper(document.getElementById('commentaire'));" id="commentaire" name="commentaire" class="form-control"><?= isset($item) ? $item->commentaire : '' ?></textarea>

	<!-- How many points were lost on the license -->
	<label>Points</label>
	<input type="number" id="points" name="points" min="0" max="6" step="1" value="<?= isset($item) ? $item->points : '' ?>" class="form-control" required>

	<!-- How much it cost -->
	<label>Prix</label>
	<input type="number" id="prix" name="prix" value="<?= isset($item) ? $item->prix : '' ?>" class="form-control" required>

	<!-- Did you get a parking ticket -->
	<label>Stationnement</label>
	<div>
		<input type="checkbox" id="stationnement" name="stationnement" value="1" <?= (isset($item) && $item->stationnement) ? 'checked' : '' ?>>
	</div>

	<!-- Redirection button -->
	<a href="<?= site_url('Infraction') ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>


<script src="<?= base_url('js/main.js') ?>"></script>

<?= $this->endSection() ?>
