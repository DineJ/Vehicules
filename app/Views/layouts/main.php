<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? 'Mon Site' ?></title> <!-- Page title (fallback to "Mon Site" if $title is not set) -->

	<!-- Bootstrap CSS for styling -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('css/main.css') ?>">

</head>
<body class="<?= $page ?? '' ?>">
	<!-- Shared navigation bar -->
	<?= $this->include('Partials/navbar') ?>

	<!-- Main page content container -->
	<div class="container mt-5">
		<?= $this->renderSection('content') ?> <!-- Content from each specific page -->
	</div>

	<!-- Bootstrap JS bundle for interactivity -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
