<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Lieux</h2>
<a href="<?= site_url('Lieu/create') ?>" class="btn btn-success">Ajouter</a>



<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Surnom</th>
				<th>Ville</th>
				<th>Code postal</th>
				<th>Numéro</th>
				<th>Adresse</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Surnom"><?= esc($item->surnom) ?></td>
					<td data-label="Ville"><?= esc($item->nom_lieu) ?></td>
					<td data-label="Code postal"><?= esc($item->code_postal) ?></td>
					<td data-label="Numéro"><?= esc($item->numero) ?></td>
					<td data-label="Adresse"><?= esc($item->adresse) ?></td>
					<td>
						<!-- Redirection button -->
						<a href="<?= site_url('Lieu/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>
