<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>
<form method="post" action="<?= site_url('Type_incident/store/') ?>">

	<!-- Type name -->
	<label>Nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>

	<!-- Check critical issue -->
	<label>Critique</label>
	<div>
		<input type='checkbox' id='critique' name='critique' value='1' <?= (isset($item) && $item->critique) ? 'checked' : '' ?>>
	</div>

	<!-- Track pathing -->
	 <?php if (!empty($fromIncident) && $fromIncident === 'incident'): ?>
		<input type="hidden" name="from" value="incident">
	<?php endif; ?>

	<!-- Catch error -->
	<?php if (session()->getFlashdata('error')): ?>
		<div class="alert alert-danger">
			<?= session()->getFlashdata('error') ?>
		</div>
	<?php endif; ?>

	<!-- Redirection button -->
	<a href="<?= (isset($fromIncident) && $fromIncident === 'incident') ? site_url('Incident/create?from=type_incident') : site_url('Type_incident') ?>" id="btnRetour" class="btn btn-secondary mt-3">Retour</a>

	<!-- Submit button -->
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