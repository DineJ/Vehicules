 <!-- Extend base layout -->
<?= $this->extend('layouts/main') ?>

 <!-- Start main content section -->
<?= $this->section('content') ?>

<h2>Login</h2>

<!-- Login form -->
<form method="post" action="<?= site_url('Login/log') ?>" class="mb-3">
	<div class="mb-2">

		<!-- Password input with length constraints -->
		<input type="password" id="clef_connexion" name="clef_connexion" class="form-control"
				minlength="16" maxlength="32"
				placeholder="Mot de passe entre 16 et 32 caracteres" required>
	</div>

	<!-- Submit button -->
	<button type="submit" class="btn btn-primary">Connexion</button>

	<!-- Display flash error message if exists -->
	<?php if (session()->getFlashdata('error')): ?>
		<div class="alert alert-danger">
			<?= session()->getFlashdata('error') ?>
		</div>
	<?php endif; ?>
</form>

<!-- End content section -->
<?= $this->endSection() ?>
