<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Login</h2>

<form method="post" action="<?= site_url('Login/log') ?>" class="mb-3">
	<div class="mb-2">
	<input type="password" id="clef_connexion" name="clef_connexion" class="form-control" minlength="16" maxlength="32" placeholder="Mot de passe entre 16 et 32 caracteres" required>
	</div>
	<button type="submit" class="btn btn-primary">Connexion</button>

	<?php if (session()->getFlashdata('error')): ?>
	<div class="alert alert-danger">
		<?= session()->getFlashdata('error') ?>
	</div>
	<?php endif; ?>

</form>

<?= $this->endSection() ?>
