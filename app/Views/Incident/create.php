<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2><?= $title ?></h2>

<form method="post" id="incidentForm" action="<?= site_url('Incident/store/') ?>">

	<!-- Display all vehicles into a list -->
	<label for="id_vehicule">Vehicule</label>
	<select id="id_vehicule" name="id_vehicule" onchange="disabledDefault('id_vehicule')" class="form-control" required>
		<option value="">    Choisir un vehicule    </option>
		<?php foreach ($vehicules as $v): ?>
			<option value="<?= $v->id ?>" <?= (isset($item) && $item->id_vehicule == $v->id) ? 'selected' : '' ?>>
				<?= $v->plaque ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Select a date -->
	<label>Date Incident</label>
	<input type='date' id='date_incident' name='date_incident' max="<?= date('Y-m-d') ?>" value='<?= isset($item) ? $item->date_incident : '' ?>' class='form-control' required>

	<!-- Type a short explication -->
	<label>Explication Incident</label>
	<textarea onchange="setUpper(document.getElementById('explication_incident'));" id='explication_incident' name='explication_incident' class='form-control'><?= isset($item) ? $item->explication_incident : '' ?></textarea>

	<!-- Display all drivers into a list -->
	<label for="id_user">Conducteur</label>
	<select id="id_user" name="id_user" onchange="disabledDefault('id_user')" class="form-control" required>
		<option value="">    Choisir un conducteur    </option>
		<?php foreach ($utilisateurs as $u): ?>
			<option value="<?= $u->id ?>"
				<?= ((isset($item) && $item->id_user == $u->id) || (!empty($selectedUserId) && $selectedUserId == $u->id)) ? 'selected' : '' ?>>
				<?= $u->prenom . ' ' . $u->nom ?>
			</option>
		<?php endforeach; ?>
	</select>

	<!-- Display all incident types in a list -->
	<div class="mb-3">
		<label for="id_type_incident">Type incident</label>
		<div class="input-group">
			<select id="id_type_incident" name="id_type_incident" onchange="disabledDefault('id_type_incident')" class="form-control" required>
				<option value="">    Choisir un type d'incident    </option>
				<?php foreach ($types_incident as $ti): ?>
				<option value="<?= $ti->id ?>"
					<?= ((isset($item) && $item->id_type_incident == $ti->id) || (!empty($selectedTypeIncident) && $selectedTypeIncident == $ti->id)) ? 'selected' : '' ?>>
					<?= $ti->nom ?>
				</option>
		<?php endforeach; ?>
			</select>

			<!-- Modal to create incident type form-->
			<button type="button" id="btnAddTypeIncident" class="btn btn-purple" title="Ajouter un type" data-incident-id="">+</a>
		</div>
	</div>

	<!-- Redirection button -->
	<a href="<?= (!empty($selectedUserId)) ? site_url('User/show/'.$selectedUserId) : site_url('Incident') ?>" class="btn btn-secondary mt-3">Retour</a>

	<!-- Redirection button -->
	<button type="submit" class="btn btn-primary mt-3">Enregistrer</button>

</form>

<div>
	<div class="modal fade" id="typeIncidentModal" aria-hidden="true">
		<!-- Size -->
		<div class="modal-dialog modal-lg">
			<!-- Content -->
			<div class="modal-content">
				<!-- Title -->
				<div class="modal-header">
					<h5 class="modal-title">Créer un Type d'incident</h5>
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


<script>

	document.getElementById('btnAddTypeIncident').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent'); // Select the modal body for the "Add" modal
		const incidentId = this.dataset.incidentId; // Get the incident ID from the button dataset
		const formData = new FormData(); // Create a new empty FormData object
		formData.append('modal_id_typ_incident', incidentId); // Add the incident ID into the FormData with key "modal_id_type_incident"

		// Load form via fetch
		fetch("<?= site_url('Type_incident/create')?>", {
			method:'POST', // POST is used to send the incident ID securely
			body: formData // The FormData containing the incident ID
		})
		.then(res => res.text()) // Convert response to HTML
		.then(html => {
			modalContent.innerHTML = html; // Inject form HTML into modal body

			// Display modal after loading
			const myModal = new bootstrap.Modal(document.getElementById('typeIncidentModal'));
			myModal.show();

			// Catch modal submit
			const modalForm = modalContent.querySelector('form'); // Select the first form element into the modal content
			if (modalForm)
			{
				modalForm.addEventListener('submit', function(e) {
					e.preventDefault(); // Avoid submit conflit with main form

					const formDataModal = new FormData(modalForm); // Collect all data from the Add form

					// Send modal form data via fetch
					fetch(modalForm.action, {
						method: 'POST', // POST is used to send the incident ID securely
						body: formDataModal // The FormData containing the incident ID
					})
					.then(resp => resp.text()) // Convert response to HTML text
					.then(result => {
						myModal.hide(); // Close modal
						window.location.reload(); // Reload the current page to reflect the updated data
					})
					.catch(err => console.error(err));
				});

				const btnRetour = modalContent.querySelector('#btnRetour'); // Select the element with the matching ID into the modal content
				if (btnRetour)
				{
					btnRetour.addEventListener('click', function(e) {
						e.preventDefault(); // Avoid return
						const myReturnModal = document.getElementById('typeIncidentModal'); // Get Add modal element
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

	// Caps text
	function setUpper(element)
	{
		element.value=element.value.toUpperCase();
	}

	function disabledDefault(removeId)
	{
		const select = document.getElementById(removeId);

		if (!select)
			return;
		else if (select.options[0])
		{
			// Delete first option
			select.remove(0);
		}
	}

	// Fields to save
	const fields = ["id_vehicule", "date_incident", "explication_incident", "id_user", "id_type_incident" ];
	window.addEventListener("DOMContentLoaded", () =>
	{
		// Retrieve the value of 'id_vehicule' from localStorage
		const valueVehicule = localStorage.getItem('id_vehicule');
		// If there is no saved value just exit
		if (!valueVehicule)
			return;

		// Display saved datas from localStorage into form fields
		fields.forEach(id =>
		{
			// Get the stored value for each field ID
			const value = localStorage.getItem(id);
			if (value)
			{
				// Set the corresponding input value
				document.getElementById(id).value = value;
			}
		});
		// Get the select element for 'type incident'
		const typeIncident = document.getElementById('id_type_incident');

		// Loop through each option to find the one matching the stored name
		for (let option of typeIncident.options) {
			if (option.text === localStorage.getItem("nom"))
			{
				// Select the matching option
				option.selected = true;
				break;
			}
		}
		// Clear all data from localStorage after restoring
		localStorage.clear();
	});

	// Function triggered when submitting the form
	function submitTypeIncident()
	{
		// Save all field values in localStorage
		fields.forEach(id =>
		{
			// Also save the 'nom' field (for the select)
			const element = document.getElementById(id);
			if (element)
				localStorage.setItem(id, element.value);
		});

		const element = document.getElementById("nom");
		if (element)
			localStorage.setItem('nom', element.value);
		// Return true to confirm successful execution
		return true;
	}

</script>

<?= $this->endSection() ?>