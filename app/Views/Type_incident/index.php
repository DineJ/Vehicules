<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des types d'incidents</h2>
<a href="<?= site_url('Type_incident/create') ?>" class="btn btn-success">Ajouter</a>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Nom</th>
				<th>Critique</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Nom"><?= esc($item->nom) ?></td>
					<td data-label="Critique"><?= esc($item->critique) ? 'Oui' : 'Non' ?></td>
					<td data-label="Actions">
						<!-- Redirection button -->
						<a href="<?= site_url('Type_incident/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>