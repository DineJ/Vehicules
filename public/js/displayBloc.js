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

displayDiv();
