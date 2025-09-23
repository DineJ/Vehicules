<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>

		<!-- Display car invovled into incident -->
		<tr>
			<td>Vehicule</td>
			<td><?= $vehicule->plaque ?></td>
		</tr>

		<!-- Display date of incident -->
		<tr>
			<td>Date Incident</td>
			<td><?= substr($item->date_incident, 0, 10) ?></td>
		</tr>

		<!-- Display short explication of incident -->
		<tr>
			<td>Explication Incident</td>
			<td class="long-text"><?= $item->explication_incident ?></td>
		</tr>

		<!-- Display driver during incident -->
		<tr>
			<td>Conducteur</td>
			<td><?= $utilisateur->prenom . ' ' . $utilisateur->nom ?></td>
		</tr>

		<!-- Display kind of incident -->
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
		<?php if (!isset($suivi))
		{
		?>

			<!-- Redirection button to create suivi form-->
			<a href="<?= site_url('Suivi/create/'.$item->id) ?>" class="btn btn-success">Ajouter</a>
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
										<td>Date Intervention</td>
										<td data-label="Date Intervention"><?= date('d/m/Y', strtotime($s->date_intervention)) ?></td>
									</tr>

									<!-- Display description -->
									<tr>
										<td>Description</td>
										<td class="long-text"><?= $s->description ?></td>
									</tr>
								</tbody>
							</table>

							<a href="<?= site_url('Suivi/edit/' . $s->id) ?>" class="btn btn-warning">Modifier</a>
							</br>
							</br>
						<?php endforeach; ?>

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

	document.addEventListener("DOMContentLoaded", function() {
		const btn = document.getElementById('btnAddType');

		// Get ID from current URL (last segment)
		const urlSegments = window.location.pathname.split('/');
		const incidentId = urlSegments[urlSegments.length - 1];
		btn.dataset.incidentId = incidentId;
	});

	document.getElementById('btnAddType').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent');
		const incidentId = this.dataset.incidentId;
		const formData = new FormData();
		formData.append('modal_id_incident', incidentId); // match with controller key

		// Load form via fetch
		fetch("<?= site_url('Suivi/create') ?>", {
				method:'POST', // POST is used to send the incident ID securely
				body: formData // The FormData containing the incident ID
			})
			.then(res => res.text()) // Convert response to HTML
			.then(html => {
				modalContent.innerHTML = html; // Inject form HTML into modal

				// Display modal after loading
				const myModal = new bootstrap.Modal(document.getElementById('suiviModal'));
				myModal.show();

				// Catch modal submit
				const modalForm = modalContent.querySelector('form');
				if(modalForm) {
					modalForm.addEventListener('submit', function(e) {
						e.preventDefault(); // Avoid submit conflit with main form

						const formDataModal = new FormData(modalForm);

						// Send modal form data via fetch to its action URL
						fetch(modalForm.action, {
							method: 'POST',
							body: formDataModal
						})
						.then(resp => resp.text())
						.then(result => {
							myModal.hide(); // Close modal
						})
						.catch(err => console.error(err));
					});

				const btnRetour = modalContent.querySelector('#btnRetour');
				if(btnRetour)
					{
						btnRetour.addEventListener('click', function(e) {
							e.preventDefault(); // Avoid return
							const myReturnModal = document.getElementById('suiviModal');
							const modal = bootstrap.Modal.getInstance(myReturnModal);
							modal.hide(); // Close modal
						});
					}
				}
			})
			.catch(err => {
				modalContent.innerHTML = "Erreur lors du chargement du formulaire.";
				console.error(err);
			});
	});

</script>
<?= $this->endSection() ?>
