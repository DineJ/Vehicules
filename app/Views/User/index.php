<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Users</h2>
<a href="<?= site_url('User/create') ?>" class="btn btn-success">Ajouter</a>


<!-- Search bar -->
<form method="get" action="<?= site_url('User') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher..." value="<?= isset($search) ?  esc($search) : '' ?>">
		<button type="submit" class="btn btn-primary">Rechercher</button>

		<!-- Reset search bar -->
		<?php if (!empty($search)) : ?>
			<a href="<?= site_url('User') ?>" class="btn btn-outline-secondary">Réinitialiser</a>
		<?php endif; ?>
	</div>
</form>


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

	<!-- Display datas -->
	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= $item->nom ?></td>
				<td><?= $item->prenom ?></td>
				<td><?= $item->telephone ?></td>
				<td><?= $item->mail ?></td>
				<td>

					<!-- Redirection button -->
					<a href="<?= site_url('User/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<!-- Pagination -->
<?php if ($pager->getPageCount() > 1)
	 { ?>
	<nav aria-label="Page navigation example">
		<ul class="pagination">

			<!-- Button for previous page -->
			<li class="page-item <?= $pager->getCurrentPage() != 1 ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getPreviousPageURI() ?>">Précédent</a></li>

			<?php
				// $count = total number of pages, $cur = current page, $nb_page = pages shown around current, $v1 = before, $v2 = after
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

				// Display the correct number of pages
				for ($value = $v1 ; $value <= $v2; $value++ )
				{
					echo '<li '.($cur == $value ? 'class="active"' : 'class="page-item"' ).'><a class="page-link" href="'.$pager->getPageURI($value).'">'.$value.'</a></li>';
				}
				?>

			<!-- Button for next page -->
			<li class="page-item <?= $pager->hasMore() ? '' : 'disabled' ?>"><a class="page-link" href="<?= $pager->getNextPageURI() ?>">Suivant</a></li>
		  </ul>
	</nav>
<?php } ?>

<?= $this->endSection() ?>
