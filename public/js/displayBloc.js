// Display div
function displayDiv()
{
	// Select all elements that will triger the cascade (<select class="trigger">)
	document.querySelectorAll('.trigger').forEach(select => {
		// Add an event listener that runs when the value changes
		select.addEventListener('change', function() {
			// Get the id of the target block from the data-target attribute
			const targetId = this.dataset.target;
			// Get the corresponding block element to show/hide
			const target = document.getElementById(targetId);

			// Hide all following blocks
			document.querySelectorAll('.bloc').forEach(bloc => {
				// Compare block ids and hide blocks that come after
				if (bloc.id >= targetId) {
					bloc.style.display = 'none';
					resetDiv(bloc);
				}
			});

			// If a value is selected display the next block
			if (this.value !== '') {
				target.style.display = 'block';

				const focusField = target.querySelector('input, select');
				if (focusField)
				{
					focusField.focus();
				}
			}
		});
	});
}

// Reset div
function resetDiv(bloc)
{
	bloc.querySelectorAll('select').forEach(doc => {
		// Reset value
		if (doc.tagName === 'SELECT')
		{
			// Reset on the first option
			doc.selectedIndex = 0;
		}
		else
		{
			doc.value = '';
		}
		if (doc.value != '')
		{
			doc.value = '';
		}
	});
}


// Prefill an input from a select
function prefill(fillId, idFilled)
{
	// Get the select element
	const select = document.getElementById(fillId);
	// Get the input field
	const field  = document.getElementById(idFilled);

	// Stop execution if one of the elements does not exist
	if (!select || !field) return;

	// Function that applies the prefill logic
	function apply()
	{

		// Get the currently selected option
		const option = select.options[select.selectedIndex];
		// Read the value from the data-fill attribute
		const fillValue = option ? option.dataset.fill : undefined;

		// If a value exists, fill the input and lock it
		if (fillValue !== undefined && fillValue !== '' && fillValue > 0)
		{
			field.value = fillValue;
			field.setAttribute('readonly', 'readonly');
		}
		// Otherwise, clear the input and make it editable
		else
		{
			field.value = '';
			field.removeAttribute('readonly');
		}
	}

	// Apply prefill on change
	select.addEventListener('change', apply);
	// Apply the prefill once on page load
	apply();
}

// Fill a hidden field
function fill(fillId, idFilled)
{
	document.getElementById(fillId).value = document.getElementById(idFilled).value
	return true;
}

displayDiv();
