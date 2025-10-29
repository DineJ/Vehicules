<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Login</h2>

<form method="post" id="form-login" name="form-login" action="<?= site_url('Login/log') ?>" autocomplete="off" class="mb-3">
	<div class="mb-2">
		<!-- Password input with length constraints -->
		<div id="qr-reader" style="width:300px; display:block;"></div>
		<input type="password" id="clef_connexion" name="clef_connexion" class="form-control"
				minlength="16" maxlength="32"
				placeholder="Mot de passe entre 16 et 32 caracteres" autocomplete="new-password" required>
	</div>

	<!-- Display flash error message if exists -->
	<?php if (session()->getFlashdata('error')): ?>
		<div class="alert alert-danger">
			<?= session()->getFlashdata('error') ?>
		</div>
	<?php endif; ?>

</form>


<script src="https://unpkg.com/html5-qrcode"></script>
<script src="<?= base_url('js/admin.js') ?>"></script>


<?= $this->endSection() ?>
