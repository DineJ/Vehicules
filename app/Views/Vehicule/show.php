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

		<!-- Redirection button to edit vehicule form -->
		<a href="<?= site_url('Vehicule/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled vehicule button -->
		<input type="hidden" name="actif" id="actif" value="<?= esc($item->actif ? 0 : 1, 'attr') ?>">
		<input type="hidden" name="redirect_url" value="<?= esc(current_url(), 'attr'); ?>">
		<button type="submit" class="btn <?= $item->actif ? 'btn-danger' : 'btn-success' ?>"> <?= $item->actif ? 'Rendre inactif' : 'Rendre actif' ?></button>

	</form>
</div>



<!-- Creation of a section incident -->
<div style="margin-left: 3rem; margin-top: 1.5rem; width: 95%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">
	<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
		<h6 style="margin: 0; color: #6f42c1;">↳ Incident</h6>
	</div>
	<div id="table_incident" class="table-responsive">

		<!-- Test if a vehicule has an incident or not -->
		<?php if (!isset($incident) || empty($incident))
		{
		?>
			<table class="table table-striped table-bordered mt-3">
				<tbody>
					<!-- Vehicule has no Incident yet -->
					<tr>
						<td class="label-permis">Pas d'incident enregistré</td>
					</tr>
				</tbody>
			</table>
		<?php
		}
		else
		{
		?>
			<?php foreach($incident as $i) : ?>
				<table class="table table-striped table-bordered mt-3">
					<tbody>

						<!-- Display plaque -->
						<tr>
							<td class="td-hidden">Vehicule</td>
							<td data-label="Plaque"><?= esc($i->vehicule) ?></td>
						</tr>

						<!-- Display description -->
						<tr>
							<td class="td-hidden">Date Incident</td>
							<td data-label="Description"><?= date('d/m/Y', strtotime($i->date_incident)) ?></td>
						</tr>

						<!-- Display short explication of the incident -->
						<tr>
							<td>Explication Incident</td>
							<td data-label="Explication Incident" class="long-text"><?= $i->explication_incident ?></td>
						</tr>

						<!-- Display driver involved in the incident -->
						<tr>
							<td>Conducteur</td>
							<td data-label="Conducteur"><?= $i->user ?></td>
						</tr>

						<!-- Display incident type -->
						<tr>
							<td>Type Incident</td>
							<td data-label="Type Incident"><?= $i->typeIncident ?></td>
						</tr>
					</tbody>
				</table>

				<!-- Redirection button to edit incident form -->
				<button type="button" class="btn btn-orange btnEditType" id="btnEditType" data-vehicule-id="<?= $i->id ?>">Modifier</button>
				</br>
				</br>
			<?php endforeach; ?>


			<div>
				<div class="modal fade" id="incidentModalEdit" aria-hidden="true">
					<!-- Size -->
					<div class="modal-dialog modal-lg">
						<!-- Content -->
						<div class="modal-content">
							<!-- Title -->
							<div class="modal-header">
								<h5 class="modal-title">Modifier un Incident</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
							</div>
							<!-- Form body -->
							<div class="modal-body" id="modalContentEdit">
								<?php
									$no_navbar = 'no_navbar';
									echo view('Partials/navbar', ['no_navbar' => $no_navbar]);
								?>
								<!-- In case loading takes time -->
								Chargement...
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>


<!-- Redirection button -->
<a href="<?= site_url('Vehicule') ?>" class="btn btn-secondary">Retour</a>

<script>
	const urlEditIncident = "<?= site_url('Incident/edit').'/' ?>"
</script>
<script src="<?= base_url('js/main.js') ?>"></script>
<script src="<?= base_url('js/validateForm.js') ?>" ></script>
<script src="<?= base_url('js/modalVehiculeShow.js') ?>"></script>

<?= $this->endSection() ?>