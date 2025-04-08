<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Users</h2>
<a href="<?= site_url('User/create') ?>" class="btn btn-success">Ajouter</a>

<form method="get" action="<?= site_url('User') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= esc($search) ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('User') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>

<table class="table table-bordered mt-3">
	<thead>
		<tr>
			<th>nom</th>
			<th>prenom</th>
			<th>telephone</th>
			<th>mail</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= $item->nom ?></td>
				<td><?= $item->prenom ?></td>
				<td><?= $item->telephone ?></td>
				<td><?= $item->mail ?></td>
				<td><a href="<?= site_url('User/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Liens de pagination -->
<!-- <div class="pagination-container">
	<?php /* $pager->links()*/ ?>
</div> -->

<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item <?= $pager->getCurrentPage() != 1 ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getPreviousPageURI() ?>">Previous</a></li>
    <li class="page-item <?= $pager->hasMore() ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getNextPageURI() ?>">Next</a></li>
  </ul>
</nav>

<style>
	.pagination {
		display: flex;
		justify-content: center;
		margin-top: 30px;
	}

	.pagination li {
		margin: 0 5px;
	}

	.pagination li a {
		border-radius: 5px;  /* Légèrement arrondi */
		color: #000;  /* Texte en noir */
		padding: 8px 16px;
		font-weight: bold;
		transition: background-color 0.3s ease;
		text-decoration: none;  /* Enlever le soulignement */
		border: none;  /* Supprimer la bordure autour des chiffres */
	}

	.pagination li a:hover {
		background-color: #f1f1f1;  /* Légère teinte de fond au survol */
	}

	.pagination .active a {
		border: 2px solid;
	}
</style>
<?= $this->endSection() ?>
