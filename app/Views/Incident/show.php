<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>id_vehicule</td>
			<td><?= $item->id_vehicule ?></td>
		</tr>
		<tr>
			<td>date_incident</td>
			<td><?= $item->date_incident ?></td>
		</tr>
		<tr>
			<td>explication_incident</td>
			<td><?= $item->explication_incident ?></td>
		</tr>
		<tr>
			<td>id_user</td>
			<td><?= $item->id_user ?></td>
		</tr>
		<tr>
			<td>id_type_incident</td>
			<td><?= $item->id_type_incident ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>">
		<a href="<?= site_url('Incident') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		
	</form>
</div>

<?= $this->endSection() ?>