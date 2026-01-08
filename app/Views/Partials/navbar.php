<?php
use CodeIgniter\HTTP\URI;

$currentUri = service('uri')->getPath();
?>
<nav id="navbar" class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4 py-2 <?= isset($no_navbar) ? 'no_navbar' : '' ?>">
	<div class="container-fluid">

		<div class="d-flex justify-content-start">
			<a class="navbar-brand fw-bold" href="/">
				<img src="https://www.asolidr.fr/wp-content/uploads/2025/05/cropped-ASolidr-256.png" alt="Logo" height="30" class="me-2">
			</a>
		</div>

		<div class="d-flex justify-content-center h5 mb-0" style="width: inherit;">
				<?= (session()->get('user')['admin'] ?? false) ? 'Tableau de bord administrateur' : 'Espace utilisateur' ?>
		</div>

		<?php if ($currentUri !== '/Login/log' && $currentUri !== '/Login'): ?>
			<div class="ms-auto d-flex justify-content-end">
				<div class="dropdown">
					<a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
						<?= session()->get('user')['name'] ?? 'Menu' ?>
					</a>
		<?php endif; ?>

			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
				<?php if (session()->get('user')['admin'] ?? false): ?>
					<li><a class="dropdown-item" href="/Admin">Home</a></li>
					<li><a class="dropdown-item" href="/Ip">IP</a></li>
				<?php endif; ?>
				<li><hr class="dropdown-divider"></li>

				<?php if ($currentUri !== '/Login/log' && $currentUri !== '/Login'): ?>
					<li><a class="dropdown-item" href="/Assurance">Assurance</a></li>
					<li><a class="dropdown-item" href="/Incident">Incident</a></li>
					<li><a class="dropdown-item" href="/Infraction">Infraction</a></li>
					<li><a class="dropdown-item" href="/Mission">Mission</a></li>
					<li><a class="dropdown-item" href="/Lieu">Lieu</a></li>
					<li><a class="dropdown-item" href="/Suivi">Suivi</a></li>
					<li><a class="dropdown-item" href="/Type_incident">Type incident</a></li>
					<li><a class="dropdown-item" href="/User">Utilisateur</a></li>
					<li><a class="dropdown-item" href="/Vehicule">Véhicule</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="/Login/logout">Déconnexion</a></li>
				<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</nav>
