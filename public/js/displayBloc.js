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
				}
			});

			// If a value is selected display the next block
			if (this.value !== '') {
				target.style.display = 'block';
			}
		});
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
		if (fillValue !== undefined && fillValue !== '')
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

displayDiv();
