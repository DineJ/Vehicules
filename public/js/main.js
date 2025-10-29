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
		return;
	else if (select.options[0])
	{
		// Delete first option
		select.remove(0);
	}
}