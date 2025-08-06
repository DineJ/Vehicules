<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->

<!-- Main content -->
<div class="container mt-4">
	<h2>Bienvenue sur l’espace admin</h2>
</div>

<div class="table-responsive">
	<h4> Adresse IP Bannies </h4>

	<!-- Display banned ip -->
	<table class="table table-striped table-bordered mt-3">
		<ul class="list-group">

		<?php foreach ($ip as $ips): ?>
			<li class="list-group-item">
				<?= esc($ips->adresse_ip) ?>
			</li>
		<?php endforeach; ?>

		</ul>
	</table>
</div>


<?= $this->endSection() ?> <!-- End the content section -->
