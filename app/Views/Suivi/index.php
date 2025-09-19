<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Suivis</h2>


<!-- Search bar -->
<form method="get" action="<?= site_url('Suivi') ?>" class="mb-3">
	<div class="input-group">
		<input type="text" name="q" class="form-control" placeholder="Rechercher : Plaque XX-XXX-XX  | Date : AAAA-MM-DD " value="<?= isset($search) ?  esc($search) : '' ?>">
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
					<td>
						<!-- Redirection button -->
						<a href="<?= site_url('Suivi/show/'.$item->id) ?>" class="btn btn-info btn-sm">Voir</a>
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