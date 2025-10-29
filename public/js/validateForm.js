// Check if values are changed or not; returns an error if they are not
function validateFormIncidentCreate()
{

	// Counter
	let compare = 0;
	let row = 0;

	// Get values
	let id_vehicule = document.getElementById('id_vehicule').value;
	let oldid_vehicule = document.getElementById('oldid_vehicule').value;
	row++;

	// Check values
	if (id_vehicule == oldid_vehicule)
	{
		compare++;
	}

	// Get values
	let date_incident = document.getElementById('date_incident').value;
	let olddate_incident = document.getElementById('olddate_incident').value;
	row++;

	// Check values
	if (date_incident == olddate_incident)
	{
		compare++;
	}

	// Get values
	let explication_incident = document.getElementById('explication_incident').value;
	let oldexplication_incident = document.getElementById('oldexplication_incident').value;
	row++;

	// Check values
	if (explication_incident == oldexplication_incident)
	{
		compare++;
	}

	// Get values
	let id_user = document.getElementById('id_user').value;
	let oldid_user = document.getElementById('oldid_user').value;
	row++;

	// Check values
	if (id_user == oldid_user)
	{
		compare++;
	}

	// Get values
	let id_type_incident = document.getElementById('id_type_incident').value;
	let oldid_type_incident = document.getElementById('oldid_type_incident').value;
	row++;

	// Check values
	if (id_type_incident == oldid_type_incident)
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


//////////////////////////////////////////////


function validateFormPermis()
{

	let compare = 0;
	let row = 0;

	let num_permis = document.getElementById('num_permis').value;
	let oldnum_permis = document.getElementById('oldnum_permis').value;
	row++;

	if (num_permis == oldnum_permis)
	{
		compare++;
	}

	let date_permis = document.getElementById('date_permis').value;
	let olddate_permis = document.getElementById('olddate_permis').value;
	row++;

	if (date_permis == olddate_permis)
	{
		compare++;
	}

	let update_permis = document.getElementById('update_permis').value;
	let oldupdate_permis = document.getElementById('oldupdate_permis').value;
	row++;

	if (update_permis == oldupdate_permis)
	{
		compare++;
	}

	let type_permis = document.getElementById('type_permis').value;
	let oldtype_permis = document.getElementById('oldtype_permis').value;
	row++;

	if (type_permis == oldtype_permis)
	{
		compare++;
	}

	if (compare == row)
	{
		alert("les valeurs sont identiques");
		return false;
	}
	return true;
}

function selectedPermis()
{
	const oldSelect = document.getElementById('oldtype_permis');

	if (oldSelect)
	{
		const oldValue = oldSelect.value;
		const select = document.getElementById('type_permis');
		if (select)
		{
			select.value = oldValue;
		}
	}

}

// function call
selectedPermis();


//////////////////////////////////////////////


function validateFormSuivi()
{

	// Count
	let compare = 0;
	let row = 0;

	// Get values
	let id_incident = document.getElementById('id_incident').value;
	let oldid_incident = document.getElementById('oldid_incident').value;
	row++;

	// Check values 
	if (id_incident == oldid_incident)
	{
		compare++;
	}

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


//////////////////////////////////////////////


function validateFormTypeIncident()
{

	let compare = 0;
	let row = 0;

	let nom = document.getElementById('nom').value;
	let oldnom = document.getElementById('oldnom').value;
	row++;

	if (nom == oldnom)
	{
		compare++;
	}

	let critique = (document.getElementById('critique').checked ? 1 : 0 );
	let oldcritique = document.getElementById('oldcritique').value;
	row++;

	if (critique == oldcritique)
	{
		compare++;
	}

	if (compare == row)
	{
		alert("les valeurs sont identiques");
		return false;
	}
	return true;
}


//////////////////////////////////////////////

// Check if values are changed or not; returns an error if they are not
function validateFormUser()
{

	// Count
	let compare = 0;
	let row = 0;

	// Get values
	let nom = document.getElementById('nom').value;
	let oldnom = document.getElementById('oldnom').value;
	row++;

	// Check values
	if (nom == oldnom)
	{
		compare++;
	}

	// Get values
	let prenom = document.getElementById('prenom').value;
	let oldprenom = document.getElementById('oldprenom').value;
	row++;

	// Check values
	if (prenom == oldprenom)
	{
		compare++;
	}

	// Get values
	let password = document.getElementById('clef_connexion').value;
	row++;

	// Check values
	if (password.length === 0)
	{
		compare++;
	}

	// Get values
	let admin = (document.getElementById('admin').checked ? 1 : 0 );
	let oldadmin = document.getElementById('oldadmin').value;
	row++;

	// Check values
	if (admin == oldadmin)
	{
		compare++;
	}

	// Get values
	let telephone = document.getElementById('telephone').value;
	let oldtelephone = document.getElementById('oldtelephone').value;
	row++;

	// Check values
	if (telephone == oldtelephone)
	{
		compare++;
	}

	// Get values
	let mail = document.getElementById('mail').value;
	let oldmail = document.getElementById('oldmail').value;
	row++;

	// Check values
	if (mail == oldmail)
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


//////////////////////////////////////////////


function validateFormIncidentShow()
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