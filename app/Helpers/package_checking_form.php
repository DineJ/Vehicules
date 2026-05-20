<?php
# Display a form
function vehicle_checking_form($title,$rows,$checkboxs,$images,$size=200,)
{ ?>
	<h2 class="text-center text-danger fw-bold p-3 rounded"><?= $title ?></h2>

	<?php foreach ($images as $image): ?>
		<img class="d-block mx-auto" src="<?= base_url('images/'.$image) ?>" alt="Image véhicule" width="<?= $size ?>">
	<?php endforeach ?>

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
<?php
}
?>

<?php vehicle_checking_form("Usure des pneus",["front_tires" => "Pneux avant","rear_tires" => "Pneux arrière"], ["Usés","Pas usés"], ["pneu_usé.png"]) ?>
