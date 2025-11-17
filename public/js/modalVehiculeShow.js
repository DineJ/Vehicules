
function editModal() {

	const btn = document.getElementById('btnEditType'); // Select the "Add" button by its ID
	const urlSegments = window.location.pathname.split('/'); // Split the URL path by "/" to create an array of segments
	const vehiculeId = urlSegments[urlSegments.length - 1]; // Take the last segment of the URL (supposed to be the vehicule ID)
	btn.dataset.vehiculeId = vehiculeId; // Store the vehiculeId in the button's dataset (data-vehicule-id)

	// Select all elements with class "btnEditType"
	document.querySelectorAll('.btnEditType').forEach(editBtn => {
		editBtn.addEventListener('click', function() {
			const modalContentEdit = document.getElementById('modalContentEdit'); // Select the modal body container for editing content
			const incidentId = this.dataset.vehiculeId; // Get the "vehiculeId" stored in the clicked button's dataset

			// Make a GET request to fetch the edit form for the given incident ID
			fetch(urlEditIncident)
			.then(res => res.text()) // Convert the response into plain text (HTML)
			.then(html => {
				modalContentEdit.innerHTML = html; // Inject the fetched HTML form into the edit modal body

				const myModalEdit = new bootstrap.Modal(document.getElementById('incidentModalEdit')); // Create a new Bootstrap Modal instance for the edit modal
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
							if (validateFormIncidentEdit())
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
							const myReturnModal = document.getElementById('incidentModalEdit'); // Get the edit modal element
							const modal = bootstrap.Modal.getInstance(myReturnModal); // Get the Bootstrap modal instance for that element
							modal.hide(); // Hide the modal when clicking "Retour"
						});
					}
				}
			});
		});
	});
}

editModal();
