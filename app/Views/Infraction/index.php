<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Infractions</h2>
<a href="<?= site_url('Infraction/create') ?>" class="btn btn-success">Ajouter</a>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Trajet</th>
				<th>Date infraction</th>
				<th>Commentaire</th>
				<th>Points</th>
				<th>Prix</th>
				<th>Stationnement</th>
				<th>Actions</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Trajet"><?= esc($item->id_mission) ?></td>
					<td data-label="Date infraction"><?= esc($item->date_infraction) ?></td>
					<td data-label="Commentaire"><?= esc($item->commentaire) ?></td>
					<td data-label="Points"><?= esc($item->points) ?></td>
					<td data-label="Prix"><?= esc($item->prix) ?></td>
					<td data-label="Stationnement"><?= esc($item->stationnement) ?></td>

					<td>
						<!-- Redirection button -->
						<a href="<?= site_url('Infraction/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>


<!-- Pager -->
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
