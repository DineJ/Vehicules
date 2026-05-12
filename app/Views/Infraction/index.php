<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Infractions</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Date infraction</th>
				<th>Commentaire</th>
				<th>Points</th>
				<th>Prix</th>
				<th>Stationnement</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Date infraction"><?= esc(date('d/m/Y', strtotime($item->date_infraction))) ?></td>
					<td data-label="Commentaire"><?= esc($item->commentaire) ?></td>
					<td data-label="Points"><?= esc($item->points) ?></td>
					<td data-label="Prix"><?= esc($item->prix) ?></td>
					<td data-label="Stationnement"><?= esc($item->stationnement) ? 'Oui' : 'Non' ?></td>

					<td class="d-flex justify-content-between">
						<!-- Redirection button -->
						<a href="<?= site_url('Infraction/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
						<a href="<?= site_url('Mission/show/'.$item->id_mission) ?>" class="btn btn-primary btn-sm">Voir mission</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
