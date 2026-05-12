<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Suivis</h2>


<!-- Search bar -->
<form method="get" action="<?= site_url('Suivi') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher : Plaque XX-XXX-XX" value="<?= isset($search) ?  esc($search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>

		<!-- Reset search bar -->
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('Suivi') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<thead>
			<!-- Display label -->
			<tr>
				<th>Incident</th>
				<th>Date Intervention</th>
				<th>Description</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Loop to display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Incident" class="long-text">
						<?= esc('Vehicule : ' . $item->plaque . ' — Date : ' . date('d/m/Y', strtotime($item->date_incident))) ?>
					</td>
					<td data-label="Date Intervention" ><?= esc(date('d/m/Y', strtotime($item->date_intervention))) ?></td>
					<td data-label="Description" class="long-text"><?= esc($item->description) ?></td>
					<td data-label="Actions">
						<!-- Redirection button -->
						<a href="<?= site_url('Suivi/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>

	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>