// Field to save
const fields = ["id_vehicule", "date_incident", "explication_incident", "id_user", "id_type_incident"];

function modalIncident() {
	document.getElementById('btnAddTypeIncident').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent'); // Select the modal body for the "Add" modal
		const incidentId = this.dataset.incidentId; // Get the incident ID from the button dataset
		const formData = new FormData(); // Create a new empty FormData object
		formData.append('modal_id_typ_incident', incidentId); // Add the incident ID into the FormData with key "modal_id_type_incident"

		// Load form via fetch
		fetch(urlCreateIncident, {
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
}

//////////////////////////////////////////////


function saveFields()
{
	// Retrieve the value of 'id_vehicule' from localStorage
	const valueVehicule = localStorage.getItem('id_vehicule');

	// If there is no saved value just exit
	if (!valueVehicule)
		return;

	// Display saved datas from localStorage into form fields
	fields.forEach(id => {
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

	for (let option of typeIncident.options)
	{
		if (option.text === localStorage.getItem("nom"))
		{
			// Select the matching option
			option.selected = true;
			break;
		}
	}
	// Clear all data from localStorage after restoring
	localStorage.clear();
	}


//////////////////////////////////////////////


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


// Call functions
modalIncident();
saveFields();
submitTypeIncident();
