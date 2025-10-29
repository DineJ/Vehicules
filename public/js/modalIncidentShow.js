
function editModal() {

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
			fetch(urlEditSuivi)
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
							if (validateFormIncidentShow())
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
}


function addModal() {

	document.getElementById('btnAddType').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent'); // Select the modal body for the "Add" modal
		const incidentId = this.dataset.incidentId; // Get the incident ID from the button dataset
		const formData = new FormData(); // Create a new empty FormData object
		formData.append('modal_id_incident', incidentId); // Add the incident ID into the FormData with key "modal_id_incident"

		// Load form via fetch
		fetch(urlCreateSuivi, {
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
							window.location.reload(); // Reload the current page to reflect the new datas
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
}


editModal();
addModal();