<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Vehicules</h2>
<a href="<?= site_url('Vehicule/create') ?>" class="btn btn-success">Ajouter</a>

<form method="get" action="<?= site_url("Vehicule") ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= isset($search) ?  esc($search) : "" ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url("Vehicule") ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>


<table class="table table-striped table-bordered mt-3">
	<thead>
		<tr>
			<th>plaque</th>
			<th>marque</th>
			<th>modele</th>
			<th>date_achat</th>
			<th>date_immat</th>
			<th>ct</th>
			<th>actif</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= $item->plaque ?></td>
				<td><?= $item->marque ?></td>
				<td><?= $item->modele ?></td>
				<td><?= $item->date_achat ?></td>
				<td><?= $item->date_immat ?></td>
				<td><?= $item->ct ?></td>
				<td><?= $item->actif ?></td>
				<td>
					<a href="<?= site_url('Vehicule/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<!-- Liens de pagination -->
<?php if ($pager->getPageCount() > 1)
	 { ?>
	<nav aria-label="Page navigation example">
		<ul class="pagination">
			<li class="page-item <?= $pager->getCurrentPage() != 1 ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getPreviousPageURI() ?>">Précédent</a></li>
			<?php
				$count = $pager->getPageCount();
				$cur = $pager->getCurrentPage();
				$nb_page = 1;
				$v1 = $cur - $nb_page;
				$v2 = $cur + $nb_page;

				if ($v1 < 1)
				{
					$v1 = 1;
				}

				if ($v2 > $count)
				{
					$v2 = $count;
				}

				for ($value = $v1 ; $value <= $v2; $value++ )
				{
					echo '<li '.($cur == $value ? 'class="active"' : 'class="page-item"' ).'><a class="page-link" href="'.$pager->getPageURI($value).'">'.$value.'</a></li>';
				}
				?>

			<li class="page-item <?= $pager->hasMore() ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getNextPageURI() ?>">Suivant</a></li>
		  </ul>
	</nav>
<?php } ?>

<?= $this->endSection() ?>