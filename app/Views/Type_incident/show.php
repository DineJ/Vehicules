<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de type d'incident</h2>

<div class="table-responsive">
	<table class="table table-striped table-bordered mt-3">
		<tbody>

			<!-- Display nom -->
			<tr>
				<td class="td-hidden">Nom</td>
				<td data-label="nom"><?= $item->nom ?></td>
			</tr>

			<!-- Display critique -->
			<tr>
				<td class="td-hidden">Critique</td>
				<td data-label="critique"><?= $item->critique ? 'Oui' : 'Non' ?></td>
			</tr>
		</tbody>
	</table>
</div>


<div>
	<form method="post" action="<?= site_url('Type_incident/update/'.$item->id) ?>">

		<!-- Redirection button to edit user form -->
		<a href="<?= site_url('Type_incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Disabled account button -->
		
	</form>
</div>
</br>

<!-- Redirection button -->
<a href="<?= site_url('Type_incident') ?>" class="btn btn-secondary">Retour</a>
<?= $this->endSection() ?>