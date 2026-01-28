function hideDiv(arrayHideId)
{
	arrayHideId.forEach((hideId, index) => {

		if(document.getElementById(hideId).style.display == "none")
		{
			document.getElementById(hideId).style.display = "block";
		}
		else
		{
			document.getElementById(hideId).style.display = "none";
		}
	});

	return true;
}
