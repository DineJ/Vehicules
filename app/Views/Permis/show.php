<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Permis</h2>

<table class="table table-striped table-bordered">
	<tbody>
			<tr>
			<td>num_permis</td>
			<td><?= $item->num_permis ?></td>
		</tr>
		<tr>
			<td>date_permis</td>
			<td><?= $item->date_permis ?></td>
		</tr>
		<tr>
			<td>update_permis</td>
			<td><?= $item->update_permis ?></td>
		</tr>
		<tr>
			<td>type_permis</td>
			<td><?= $item->type_permis ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Permis/update/'.$item->id_user) ?>">
		<a href="<?= site_url('Permis') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Permis/edit/'.$item->id_user) ?>" class="btn btn-warning">Modifier</a>
		
	</form>
</div>

<?= $this->endSection() ?>