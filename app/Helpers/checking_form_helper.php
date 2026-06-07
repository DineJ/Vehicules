<?php
# Display a form
function vehicle_checking_form($name,$hide,$prev,$next,$title,$rows,$checkboxs,$images,$size=200,)
{ ?>
	<div style="display:<?= $hide ?>;" name="<?= $name ?>" id="<?= $name ?>">
		<h2 class="text-center text-danger fw-bold p-3 rounded"><?= $title ?></h2>

		<div class="d-flex flex-wrap justify-content-center gap-2">
			<?php foreach ($images as $image): ?>
				<img class="center" src="<?= base_url('images/'.$image) ?>" alt="Image véhicule" width="<?= $size ?>">
			<?php endforeach ?>
		</div>

		<br>

		<table class="table table-bordered border table-striped align-middle">
			<tbody>

				<?php foreach ($rows as $key => $row): ?>
					<tr>
						<td class="fw-bold"><?= esc($row) ?></td>

						<?php
							$count = 0;
							foreach ($checkboxs as $checkbox):
						?>
							<td class="text-center">

								<label style="font-weight:bold; color:<?= ($count == 1 ? "green" : "red") ?>;">
									<input type="radio"
										id="<?= $key ?>"
										class="checking-item"
										data-images="<?= implode(',',$images) ?>"
										data-label="<?= esc($row) ?>"
										name="<?= $key ?>"
										value="<?= $checkbox ?>">
										<?= esc($checkbox)?>
								</label>
							</td>
						<?php
								$count++;
							endforeach
						?>

						</td>
					</tr>
				<?php endforeach ?>

			</tbody>
		</table>

		<?php if ($next != 'none')
		{ ?>
			<button type="button" class="btn btn-primary mt-3" onclick="nextStep('<?= $name ?>', '<?= $next ?>')">Continuer le contrôle</button>
		<?php }
		else { ?>
			<button type="submit" class="btn btn-primary mt-3">Terminer le contrôle</button>
		<?php } ?>

		<?php if ($prev != 'none')
		{ ?>
			<button type="button" class="btn btn-secondary mt-3" onclick="document.getElementById('<?= $prev ?>').style.display='block';document.getElementById('<?= $name ?>').style.display='none';">Retour</button>
		<?php }
		else
		{ ?>
		<a href="<?= site_url('Mission/debut') ?>" class="btn btn-secondary mt-3">Arrêter le contrôle</a>
		<?php } ?>

	</div>
<?php
}
?>

<script>
	function validateContainer(container, message) {
		// Get all radio buttons inside the given container
		const radios = container.querySelectorAll('input[type="radio"]');

		// Get unique radio group names
		const groups = [...new Set(Array.from(radios).map(radio => radio.name))];

		// Check if every group has one checked radio button
		for (const group of groups) {
			if (!container.querySelector(`input[name="${group}"]:checked`)) {
				alert(message);
				return false;
			}
		}

		return true;
	}

	document.getElementById('checkingForm').addEventListener('submit', function (event) {
		// Validate the entire form before allowing submit
		if (!validateContainer(this, "Veuillez répondre à toutes les questions avant de terminer le contrôle.")) {
			event.preventDefault();
			return false;
		}

		// Build JSON data for the server
		const data = {};

		document.querySelectorAll('.checking-item').forEach(function (radio) {
			if (radio.checked === true) {
				data[radio.dataset.label] = {
					etat: radio.value,
					images: radio.dataset.images
						? radio.dataset.images.split(',')
						: []
				};
			}
		});

		// Store JSON inside hidden input
		document.getElementById('explication_incident').value = JSON.stringify(data);
	});

	function validateStep(container) {
		const radios = container.querySelectorAll('input[type="radio"]');
		const groups = [...new Set(Array.from(radios).map(radio => radio.name))];

		for (const group of groups) {
			if (!container.querySelector(`input[name="${group}"]:checked`)) {
				alert("Veuillez répondre à toutes les questions avant de continuer.");
				return false;
			}
		}

		return true;
	}

	function nextStep(currentForm, nextForm) {
		const container = document.getElementById(currentForm);

		if (!validateStep(container)) {
			return;
		}

		document.getElementById(nextForm).style.display = 'block';
		container.style.display = 'none';
	}
</script>