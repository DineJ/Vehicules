<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des utilisateurs</h2>
<a href="<?= site_url('User/create') ?>" class="btn btn-success">Ajouter</a>


<!-- Search bar -->
<form method="get" action="<?= site_url('User') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher :  Nom — Prénom " value="<?= isset($search) ?  esc($search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>

		<!-- Reset search bar -->
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('User') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!--Datas name -->
		<thead>
			<tr>
				<th>Nom</th>
				<th>Prénom</th>
				<th>Téléphone</th>
				<th>Mail</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Nom"><?= esc($item->nom) ?></td>
					<td data-label="Prénom"><?= esc($item->prenom) ?></td>
					<td data-label="Téléphone"><?= esc($item->telephone) ?></td>
					<td data-label="Mail"><?= esc($item->mail) ?></td>
					<td data-label="Actions">

						<!-- Redirection button -->
						<a href="<?= site_url('User/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
