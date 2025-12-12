<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Mission - <?= $title ?></h2>

<form method="post" action="<?= site_url('Mission/store/') ?>">

	<!-- Type number -->
	<label>id_vehicule</label>
	<input type="number" id="id_vehicule" name="id_vehicule" value="<?= isset($item) ? $item->id_vehicule : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>id_user</label>
	<input type="number" id="id_user" name="id_user" value="<?= isset($item) ? $item->id_user : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>id_lieu_depart</label>
	<input type="number" id="id_lieu_depart" name="id_lieu_depart" value="<?= isset($item) ? $item->id_lieu_depart : '' ?>" class="form-control" required>

	<!-- Type number -->
	<label>id_lieu_arrive</label>
	<input type="number" id="id_lieu_arrive" name="id_lieu_arrive" value="<?= isset($item) ? $item->id_lieu_arrive : '' ?>" class="form-control" required>

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


<script>
	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}
</script>

<?= $this->endSection() ?>