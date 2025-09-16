<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
<h2>Détails de Incident</h2>

<table class="table table-striped table-bordered">
	<tbody>

		<!-- Display car invovled into incident -->
		<tr>
			<td>Vehicule</td>
			<td><?= $vehicule->plaque ?></td>
		</tr>

		<!-- Display date of incident -->
		<tr>
			<td>Date Incident</td>
			<td><?= substr($item->date_incident, 0, 10) ?></td>
		</tr>

		<!-- Display short explication of incident -->
		<tr>
			<td>Explication Incident</td>
			<td class="long-text"><?= $item->explication_incident ?></td>
		</tr>

		<!-- Display driver during incident -->
		<tr>
			<td>Conducteur</td>
			<td><?= $utilisateur->prenom . ' ' . $utilisateur->nom ?></td>
		</tr>

		<!-- Display kind of incident -->
		<tr>
			<td>Type Incident</td>
			<td><?= $type_incident->nom ?></td>
		</tr>
	</tbody>
</table>

<div>
	<form method="post" action="<?= site_url('Incident/update/'.$item->id) ?>">

		<!-- Redirection button -->
		<a href="<?= site_url('Incident') ?>" class="btn btn-secondary">Retour</a>
		<a href="<?= site_url('Incident/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>

		<!-- Modal -->
		<button type="button" class="btn btn-purple" id="btnAddType">Ajouter un suivi</button>

	</form>

	<div class="modal fade" id="suiviModal" aria-hidden="true">
		<!-- Size -->
		<div class="modal-dialog modal-lg">
			<!-- Content -->
			<div class="modal-content">
				<!-- Title -->
				<div class="modal-header">
					<h5 class="modal-title">Créer un Suivi</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
				</div>
				<!-- Form body -->
				<div class="modal-body" id="modalContent">
					<!-- In case loading takes time -->
					Chargement...
				</div>
			</div>
		</div>
	</div>

</div>

<script>

	document.getElementById('btnAddType').addEventListener('click', function() {
		const modalContent = document.getElementById('modalContent');

		// Load form via fetch
		fetch("<?= site_url('Suivi/create') ?>")
			.then(res => res.text())
			.then(html => {
				modalContent.innerHTML = html;

				// Display modal after loading
				const myModal = new bootstrap.Modal(document.getElementById('suiviModal'));
				myModal.show();

				// Catch modal submit
				const modalForm = modalContent.querySelector('form');
				if(modalForm) {
					modalForm.addEventListener('submit', function(e) {
						e.preventDefault(); // Avoid submit conflit
						const formData = new FormData(modalForm);

						fetch(modalForm.action, {
							method: 'POST',
							body: formData
						})
						.then(resp => resp.text())
						.then(result => {
							myModal.hide(); // Close modal
						})
						.catch(err => console.error(err));
					});
				}
			})
			.catch(err => {
				modalContent.innerHTML = "Erreur lors du chargement du formulaire.";
				console.error(err);
			});
	});

</script>
<?= $this->endSection() ?>