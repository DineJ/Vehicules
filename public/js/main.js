// Caps text
function setUpper(element)
{
	element.value=element.value.toUpperCase();
}


//////////////////////////////////////////////


// Remove default option of a select
function disabledDefault(removeId)
{
	const select = document.getElementById(removeId);

	if (!select)
		return true;
	else if (select.options[0].value == "")
	{
		// Delete first option
		select.remove(0);
	}
	return true
}
