<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Vehicules</h2>
<a href="<?= site_url('Vehicule/create') ?>" class="btn btn-success">Ajouter</a>

<!-- Search bar -->
<form method="get" action="<?= site_url('Vehicule') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher : Plaque XX-XXX-XX" value="<?= isset($search) ?  esc($search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>

		<!-- Reset search bar -->
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('Vehicule') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>


<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<thead>
			<!-- Datas name -->
			<tr>
				<th>Plaque</th>
				<th>Marque</th>
				<th>Modèle</th>
				<th>Date achat</th>
				<th>Date immat</th>
				<th>Contrôle technique</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Plaque"><?= esc($item->plaque) ?></td>
					<td data-label="Marque"><?= esc($item->marque) ?></td>
					<td data-label="Modèle"><?= esc($item->modele) ?></td>
					<td data-label="Date achat"><?= esc(date('d/m/Y', strtotime($item->date_achat))) ?></td>
					<td data-label="Date immat"><?= esc(date('d/m/Y', strtotime($item->date_immat))) ?></td>
					<td data-label="CT"><?= esc(date('d/m/Y', strtotime($item->ct))) ?></td>
					<td data-label="Actions">
						<!-- Redirection button -->
						<a href="<?= site_url('Vehicule/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
