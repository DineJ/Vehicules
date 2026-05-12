<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Ips</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">

		<!-- Datas name -->
		<thead>
			<tr>
				<th>Adresse IP</th>
				<th>Nombre d'échec</th>
			</tr>
		</thead>

		<tbody>
			<!-- Display datas -->
			<?php foreach ($items as $item): ?>
				<tr>
					<td data-label="Adresse Ip"><?= esc($item->adresse_ip) ?></td>
					<td data-label="Nombre d'échec"><?= esc($item->nb_echec) ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>

<?= view('Partials/pager', ['pager' => $pager]) ?>
<?= $this->endSection() ?>