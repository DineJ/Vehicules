<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Type_incident</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>nom</td>
			<td><?= $item->nom ?></td>
		</tr>
		<tr>
			<td>critique</td>
			<td><?= $item->critique ? 'Oui' : 'Non' ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Type_incident/update/'.$item->id) ?>">
		<a href="<?= site_url('Type_incident') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Type_incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
		
	</form>
</div>

<?= $this->endSection() ?>