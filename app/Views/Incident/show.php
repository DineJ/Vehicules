<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>

		<!-- Display car involved into the incident -->
		<tr>
			<td>Vehicule</td>
			<td><?= $vehicule->plaque ?></td>
		</tr>

		<!-- Display date of the incident -->
		<tr>
			<td>Date Incident</td>
			<td><?= date('d/m/Y', strtotime($item->date_incident)) ?></td>
		</tr>

		<!-- Display short explication of the incident -->
		<tr>
			<td>Explication Incident</td>
			<td class="long-text"><?= $item->explication_incident ?></td>
		</tr>

		<!-- Display driver involved in the incident -->
		<tr>
			<td>Conducteur</td>
			<td><?= $utilisateur->prenom . ' ' . $utilisateur->nom ?></td>
		</tr>

		<!-- Display incident type -->
		<tr>
			<td>Type Incident</td>
			<td><?= $type_incident->nom ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>">

		<!-- Redirection button -->
		<a href="<?= site_url('Incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Modal -->
		<button type="button" class="btn btn-purple" id="btnAddType" data-incident-id="">Ajouter un suivi</button>
	</form>

	<div class="modal fade" id="suiviModal" aria-hidden="true">
		<!-- Size -->
		<div class="modal-dialog modal-lg">
			<!-- Content -->
			<div class="modal-content">
				<!-- Title -->
				<div class="modal-header">
					<h5 class="modal-title">Créer un Suivi</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<!-- Form body -->
				<div class="modal-body" id="modalContent">
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


<!-- Creation of a section suivi -->
<div style="margin-left: 3rem; margin-top: 1.5rem; width: 95%; padding: 1rem; border: 1px solid #ccc; border-left: 4px solid #6f42c1; border-radius: 8px;">
	<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
		<h6 style="margin: 0; color: #6f42c1;">↳ Suivi</h6>

		<!-- Test if an incident has a suivi or not -->
		<?php if (!isset($suivi) || empty($suivi))
		{
		?>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-bordered mt-3">
					<tbody>
						<!-- Incident has no suivi yet -->
						<tr>
							<td class="label-permis">Pas de suivi enregistré</td>
						</tr>
		<?php
		}
		else
		{
		?>
			<!-- Redirection button to edit license form -->
			</div>
			<div id="table_suivi" class="table-responsive">
				<?php foreach($suivi as $s) : ?>
					<table class="table table-striped table-bordered mt-3">
						<tbody>
							<!-- Display date_intervention -->
							<tr>
								<td class="td-hidden">Date Intervention</td>
								<td data-label="Date Intervention"><?= date('d/m/Y', strtotime($s->date_intervention)) ?></td>
							</tr>

							<!-- Display description -->
							<tr>
								<td class="td-hidden">Description</td>
								<td data-label="Description" class="long-text"><?= $s->description ?></td>
							</tr>
						</tbody>
					</table>

					<!-- Redirection button to edit suivi form -->
					<button type="button" class="btn btn-orange btnEditType" data-incident-id="<?= $s->id ?>">Modifier</button>
					</br>
					</br>
				<?php endforeach; ?>
			</div>

			<div>
				<div class="modal fade" id="suiviModalEdit" aria-hidden="true">
					<!-- Size -->
					<div class="modal-dialog modal-lg">
						<!-- Content -->
						<div class="modal-content">
							<!-- Title -->
							<div class="modal-header">
								<h5 class="modal-title">Modifier un Suivi</h5>
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
			</tbody>
		</table>
	</div>
</div>

</br>

<!-- Redirection button -->
<a href="<?= site_url('Incident') ?>" class="btn btn-secondary">Retour</a>


<script>
	const urlCreateSuivi = "<?= site_url('Suivi/create') ?>"
	const urlEditSuivi = "<?= site_url('Suivi/edit').'/'. $suiviId->id ?>"
</script>
<script src="<?= base_url('js/validateForm.js') ?>" ></script>
<script src="<?= base_url('js/modalIncidentShow.js') ?>"></script>

<?= $this->endSection() ?>
