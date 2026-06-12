<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
	<h2>Extraction des données</h2>
	<!-- Datas you want to extract -->
	<form method="get" action="<?= site_url('Extraction/datas') ?>">
		<table class="table table-bordered align-middle">
			<thead class="table-dark">
				<th>Description</th>
				<th>Mois</th>
				<th>Année</th>
				<th>Action</th>
			</thead>

			<tbody>
				<tr>
					<td>
						Extrait les missions du mois sélectionné
					</td>

					<td>
						<select id="mois" name="mois" class="form-control" required>
							<?php
							$mois = [
								1 => 'Janvier',
								2 => 'Février',
								3 => 'Mars',
								4 => 'Avril',
								5 => 'Mai',
								6 => 'Juin',
								7 => 'Juillet',
								8 => 'Août',
								9 => 'Septembre',
								10 => 'Octobre',
								11 => 'Novembre',
								12 => 'Décembre'
							];

							// Display each month
							foreach ($mois as $numero => $libelle):
							?>
								<option value="<?= sprintf('%02d', $numero) ?>"
									<?= $numero == date('n') ? 'selected' : '' ?>>
									<?= $libelle ?>
								</option>
							<?php endforeach; ?>
						</select>
					</td>

					<td>
						<select id="annee" name="annee" class="form-control" required>
							<?php
							$anneeActuelle = date('Y');

							// Display all years since 2026
							for ($annee = 2026; $annee <= $anneeActuelle; $annee++):
							?>
								<option value="<?= $annee ?>"
									<?= $annee == $anneeActuelle ? 'selected' : '' ?>>
									<?= $annee ?>
								</option>
							<?php endfor; ?>
						</select>
					</td>

					<td>
						<button type="submit" name="type" value="mission" class="btn btn-primary">Extraction</button>
					</td>
				</tr>
			</tbody>
		</table>
	</form>
</div>

<?= $this->endSection() ?>