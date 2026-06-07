<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<style>
#userDropdown {
	display:none;
}
</style>

<?php $etatValidate = ['Ok', 'Gonflés', 'Pas usés', 'Allumés']; ?>
<div class="container mt-5">

	<h2>Contrôle véhicule : <?= esc($vehicule->plaque) ?> <br>Conducteur : <?= esc($driver) ?></h2>
	<h3>Effectué le : <?= date('d/m/Y à H:i:s'); ?></h3>

	<div class="table-responsive">
		<table class="table table-striped table-bordered mt-3">
			<tr>
				<th>Élément</th>
				<th>Images</th>
				<th>État</th>
			</tr>

			<?php 
				foreach ($checks as $element => $check):?>
					<tr>
						<td><?= esc($element) ?></td>

						<td>
							<?php
								foreach ($check['images'] as $image):
									$path = FCPATH . 'images/' . $image;
									echo '<img width="50" src="file://' . $path . '">';

								endforeach;
							?>
							
						</td>

						<td class="<?= in_array($check['etat'],$etatValidate) ? 'text-success fw-bold' : 'text-danger fw-bold' ?>">
							<?= esc($check['etat']) ?>
						</td>

					</tr>
			<?php endforeach; ?>
		</table>
	</div>

</div>
<?= $this->endSection() ?>