<?php
use CodeIgniter\HTTP\URI;

$currentUri = service('uri')->getPath();
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4 py-2">
	<div class="container-fluid">
		<a class="navbar-brand fw-bold" href="/">
			<img src="https://www.asolidr.fr/wp-content/uploads/2025/05/cropped-ASolidr-256.png" alt="Logo" height="30" class="me-2">
		</a>

		<div class="mx-auto">
			<span class="h5 mb-0">
				<?= (session()->get('user')['admin'] ?? false) ? 'Tableau de bord administrateur' : 'Espace utilisateur' ?>
			</span>
		</div>

		<?php if ($currentUri !== '/Login/log' && $currentUri !== '/Login'): ?>
			<div class="dropdown">
				<a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
					<?= session()->get('user')['name'] ?? 'Menu' ?>
				</a>
		<?php endif; ?>

			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
				<?php if (session()->get('user')['admin'] ?? false): ?>
					<li><a class="dropdown-item" href="/User">Utilisateur</a></li>
					<li><a class="dropdown-item" href="/Permis">Permis</a></li>
					<li><hr class="dropdown-divider"></li>
				<?php endif; ?>

				<?php if ($currentUri !== '/Login/log' && $currentUri !== '/Login'): ?>
					<li><a class="dropdown-item" href="/Login/logout">Déconnexion</a></li>
				<?php endif; ?>
			</ul>
		</div>
	</div>
</nav>
