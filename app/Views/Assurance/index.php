<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Assurances</h2>

<a href="<?= site_url('Assurance/create') ?>" class="btn btn-success">Ajouter</a>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Assurance</th>
				<th>Date contrat</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Assurance"><?= esc(($item->nom_assurance ?? 'Inconnu')) ?></td>
					<td data-label="Date contrat"><?= esc(date('d/m/Y', strtotime($item->date_contrat))) ?></td>
				<td data-label="Actions">
						<!-- Redirection button -->
						<a href="<?= site_url('Assurance/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
