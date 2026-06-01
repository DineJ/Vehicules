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

				<?php foreach ($rows as $row): ?>
					<tr>
						<td class="fw-bold"><?= esc($row) ?></td>

						<?php
							$count = 0;
							foreach ($checkboxs as $checkbox):
						?>
							<td class="text-center">

								<label style="font-weight:bold; color:<?= ($count == 1 ? "green" : "red") ?>;">
									<input type="radio" id="<?= esc($row) ?>" data-label="<?= esc($checkbox) ?>" name="<?= esc($row) ?>"
										value="<?= $count ?>">
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
			<button type="button" class="btn btn-primary mt-3" onclick="document.getElementById('<?= $next ?>').style.display='block';document.getElementById('<?= $name ?>').style.display='none';">Continuer le contrôle</button>
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