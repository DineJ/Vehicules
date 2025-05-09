<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Permiss</h2>
<a href="<?= site_url('Permis/create') ?>" class="btn btn-success">Ajouter</a>



<table class="table table-striped table-bordered mt-3">
	<thead>
		<tr>
			<th>num_permis</th>
			<th>date_permis</th>
			<th>update_permis</th>
			<th>type_permis</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= $item->num_permis ?></td>
				<td><?= $item->date_permis ?></td>
				<td><?= $item->update_permis ?></td>
				<td><?= $item->type_permis ?></td>
				<td>
					<a href="<?= site_url('Permis/show/'.$item->id_user) ?>" class="btn btn-info">Voir</a>
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