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
			</br>
			</br>

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
		const btn = document.getElementById('btnAddType'); // Select the "Add" button by its ID

 
		const urlSegments = window.location.pathname.split('/'); // Split the URL path by "/" to create an array of segments
		const incidentId = urlSegments[urlSegments.length - 1]; // Take the last segment of the URL (supposed to be the incident ID)
		btn.dataset.incidentId = incidentId; // Store the incidentId in the button's dataset (data-incident-id)

		// Select all elements with class "btnEditType"
		document.querySelectorAll('.btnEditType').forEach(editBtn => {
			editBtn.addEventListener('click', function() {
				const modalContentEdit = document.getElementById('modalContentEdit'); // Select the modal body container for editing content
				const suiviId = this.dataset.incidentId; // Get the "incidentId" stored in the clicked button's dataset

				// Make a GET request to fetch the edit form for the given suivi ID
				fetch("<?= site_url('Suivi/edit') ?>/" + suiviId)
				.then(res => res.text()) // Convert the response into plain text (HTML)
				.then(html => {
					modalContentEdit.innerHTML = html; // Inject the fetched HTML form into the edit modal body

					const myModalEdit = new bootstrap.Modal(document.getElementById('suiviModalEdit')); // Create a new Bootstrap Modal instance for the edit modal
					myModalEdit.show(); // Display the edit modal

					const modalFormEdit = modalContentEdit.querySelector('form'); // Look for a <form> element inside the edit modal body

					// If a form exists, attach a submit handler
					if (modalFormEdit) {
						// Add a submit event listener to the edit form
						modalFormEdit.addEventListener('submit', function(e) {
							e.preventDefault(); // Prevent default form submission (page reload/redirect)

							const formDataModalEdit = new FormData(modalFormEdit); // Create a FormData object with all form fields

							// Send the form data to the action URL of the form
							fetch(modalFormEdit.action, {
								method: 'POST',
								body: formDataModalEdit // Attach the form data to the request body
							})
							.then(resp=> resp.text()) // Convert the response to text
							.then(result => {
								// If the custom validation function returns true
								if (validateForm())
								{
									myModalEdit.hide() // Close the modal
									window.location.reload(); // Reload the current page to reflect the updated data
								}
							})
							.catch(err => console.error(err)); // Log errors in case the request fails
						});

						const btnRetour = modalContentEdit.querySelector('#btnRetour'); // Look for a button or link with ID "btnRetour" inside the edit modal
						if(btnRetour)
						{
							btnRetour.addEventListener('click', function(e) {
								e.preventDefault(); // Prevent the default behavior (navigation if <a>)
								const myReturnModal = document.getElementById('suiviModalEdit'); // Get the edit modal element
								const modal = bootstrap.Modal.getInstance(myReturnModal); // Get the Bootstrap modal instance for that element
								modal.hide(); // Hide the modal when clicking "Retour"
							});
						}
					}
				});
			});
		});
	});



	document.getElementById('btnAddType').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent'); // Select the modal body for the "Add" modal
		const incidentId = this.dataset.incidentId; // Get the incident ID from the button dataset
		const formData = new FormData(); // Create a new empty FormData object
		formData.append('modal_id_incident', incidentId); // Add the incident ID into the FormData with key "modal_id_incident"

		// Load form via fetch
		fetch("<?= site_url('Suivi/create') ?>", {
				method:'POST', // POST is used to send the incident ID securely
				body: formData // The FormData containing the incident ID
			})
			.then(res => res.text()) // Convert response to HTML
			.then(html => {
				modalContent.innerHTML = html; // Inject form HTML into modal body

				// Display modal after loading
				const myModal = new bootstrap.Modal(document.getElementById('suiviModal'));
				myModal.show();

				// Catch modal submit
				const modalForm = modalContent.querySelector('form');
				if(modalForm) {
					modalForm.addEventListener('submit', function(e) {
						e.preventDefault(); // Avoid submit conflit with main form

						const formDataModal = new FormData(modalForm); // Collect all data from the Add form

						// Send modal form data via fetch to its action URL
						fetch(modalForm.action, {
							method: 'POST',
							body: formDataModal // The FormData containing the incident ID
						})
						.then(resp => resp.text()) // Convert response to HTML text
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
							const myReturnModal = document.getElementById('suiviModal'); // Get Add modal element
							const modal = bootstrap.Modal.getInstance(myReturnModal); // Get modal instance
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

	function validateForm()
	{

		// Count
		let compare = 0;
		let row = 0;

		// Get values
		let date_intervention = document.getElementById('date_intervention').value;
		let olddate_intervention = document.getElementById('olddate_intervention').value;
		row++;

		// Check values
		if (date_intervention == olddate_intervention)
		{
			compare++;
		}

		// Get values
		let description = document.getElementById('description').value;
		let olddescription = document.getElementById('olddescription').value;
		row++;

		// Check values
		if (description == olddescription)
		{
			compare++;
		}

		// Check counts
		if (compare == row)
		{
			alert("les valeurs sont identiques");
			return false;
		}
		return true;
	}

</script>
<?= $this->endSection() ?>
