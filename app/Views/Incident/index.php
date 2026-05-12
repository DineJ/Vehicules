<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Incidents</h2>

<a href="<?= site_url('Incident/create') ?>" class="btn btn-success">Ajouter</a>

<!-- Search bar -->
<form method="get" action="<?= site_url('Incident') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher : Plaque XX-XXX-XX" value="<?= isset($search) ?  esc($search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>

		<!-- Reset search bar -->
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('Incident') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>


<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<thead>
			<!-- Display label -->
			<tr>
				<th>Incident</th>
				<th>Date Incident</th>
				<th>Explication Incident</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Loop to get datas corresponding to the id -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Incident"><?= esc(($item->vehicule ?? 'Inconnu') . ' — ' . ($item->user ?? 'Inconnu') . ' — ' . ($item->type_incident ?? 'Inconnu')) ?></td>
					<td data-label="Date Incident"><?= esc(date('d/m/Y H:i:s', strtotime($item->date_incident))) ?></td>
					<td data-label="Explication" class="long-text"><?= esc($item->explication_incident) ?></td>
					<td data-label="Actions">
						<a href="<?= site_url('Incident/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
