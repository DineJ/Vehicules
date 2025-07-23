<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->

<!-- Top navigation bar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4 py-2">
	<div class="container-fluid">

		<!-- Logo with link to homepage -->
		<a class="navbar-brand fw-bold" href="/">
			<img src="https://www.asolidr.fr/wp-content/uploads/2025/05/cropped-ASolidr-256.png" alt="Logo" height="30" class="me-2">
		</a>

		<!-- Centered dashboard title -->
		<div class="mx-auto">
			<span class="h5 mb-0">Tableau de bord administrateur</span>
		</div>

		<!-- User dropdown menu -->
		<div class="dropdown">
			<a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
				<!-- Display logged-in user's name or 'Admin' as fallback -->
				<?= session()->get('user')['name'] ?? 'Admin' ?>
			</a>

			<!-- Dropdown menu with links -->
			<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
				<li><a class="dropdown-item" href="/User">Conducteur</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="/Permis">Permis</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="/Session">Session</a></li>
				<li><hr class="dropdown-divider"></li>
				<li><a class="dropdown-item" href="/Login/logout">Déconnexion</a></li>
			</ul>
		</div>

	</div>
</nav>

<!-- Main content -->
<div class="container mt-4">
	<h2>Bienvenue sur l’espace admin</h2>
</div>

<?= $this->endSection() ?> <!-- End the content section -->
