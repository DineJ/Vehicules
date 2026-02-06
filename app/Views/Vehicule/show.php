<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
	<h2>Détails de Vehicule</h2>

	<div class="table-responsive">
		<table class="table table-striped table-bordered mt-3">
			<tbody>

				<!-- Display plaque -->
				<tr>
					<td class="td-hidden">Plaque</td>
					<td data-label="Plaque"><?= esc($item->plaque) ?></td>
				</tr>

				<!-- Display marque -->
				<tr>
					<td class="td-hidden">Marque</td>
					<td data-label="Marque"><?= esc($item->marque) ?></td>
				</tr>

				<!-- Display modele -->
				<tr>
					<td class="td-hidden">Modèle</td>
					<td data-label="Modele"><?= esc($item->modele) ?></td>
				</tr>

				<!-- Display date_achat -->
				<tr>
					<td class="td-hidden">Date achat</td>
					<td data-label="Date achat"><?= esc(date('d/m/Y', strtotime($item->date_achat))) ?></td>
				</tr>

				<!-- Display date_immat -->
				<tr>
					<td class="td-hidden">Date immat</td>
					<td data-label="Date immat"><?= esc(date('d/m/Y', strtotime($item->date_immat))) ?></td>
				</tr>

				<!-- Display ct -->
				<tr>
					<td class="td-hidden">CT</td>
					<td data-label="CT"><?= esc(date('d/m/Y', strtotime($item->ct))) ?></td>
				</tr>

				<!-- Display actif -->
				<tr>
					<td class="td-hidden">Actif</td>
					<td data-label="Actif"><?= esc($item->actif) ? 'Oui' : 'Non' ?></td>
				</tr>

			</tbody>
		</table>
	</div>


	<div>
		<form method="post" action="<?= site_url('Vehicule/update/'.$item->id) ?>">

			<!-- Redirection button -->
			<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary">Retour</a>

			<!-- Redirection button to edit vehicule form -->
			<a href="<?= site_url('Vehicule/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

			<!-- Disabled vehicule button -->
			<input type="hidden" name="actif" id="actif" value="<?= esc($item->actif ? 0 : 1, 'attr') ?>"></input>
			<input type="hidden" name="redirect_url" value="<?= esc(current_url(), 'attr'); ?>"></input>
			<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>

		</form>
	</div>

	<?= createSection($assurance, 'Assurance', 'vehicule', ['nom_assurance' => 'Assurance', 'date_contrat' => 'Contrat'], 0, 0, 0, 0); ?>
	<?= createSection($incident, 'Incident', 'vehicule', ['plaque' => 'Plaque', 'date_incident' => 'Date_incident', 'explication_incident' => 'Explication_incident', 'user' => 'Conducteur', 'typeIncident' => 'Type_incident'], 0, 1, $item->id); ?>



<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>"></script>
<script src="<?= base_url('js/popupModal.js') ?>"></script>

<?= $this->endSection() ?>
