<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Historique</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>date_fin</td>
			<td><?= $item->date_fin ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Historique/update/'.$item->date_dbt) ?>">
		<a href="<?= site_url('Historique') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Historique/edit/'.$item->date_dbt) ?>" class="btn btn-warning">Modifier</a>
		
	</form>
</div>

<?= $this->endSection() ?>