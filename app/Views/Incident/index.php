<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Incidents</h2>
<a href="<?= site_url('Incident/create') ?>" class="btn btn-success">Ajouter</a>

<table class="table table-striped table-bordered mt-3">
	<thead>
		<tr>
			<th>Véhicule</th>
			<th>Date Incident</th>
			<th>Explication Incident</th>
			<th>Conducteur</th>
			<th>Type Incident</th>
			<th>Actions</th>
		</tr>
	</thead>

	<tbody>
		<?php foreach ($items as $item): ?>
			<tr>
				<td><?= esc($vehiculeMap[$item->id_vehicule] ?? 'Inconnu') ?></td>
				<td><?= esc(substr($item->date_incident, 0, 10)) ?></td>
				<td><?= esc($item->explication_incident) ?></td>
				<td><?= esc($userMap[$item->id_user] ?? 'Inconnu') ?></td>
				<td><?= esc($typeIncidentMap[$item->id_type_incident] ?? 'Inconnu') ?></td>
				<td>
					<a href="<?= site_url('Incident/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
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