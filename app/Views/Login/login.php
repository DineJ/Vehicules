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
<script>
	document.addEventListener("DOMContentLoaded", () => {
		const qrReader = document.getElementById("qr-reader");
		const qrLogin = document.getElementById("form-login");
		const qrResult = document.getElementById("clef_connexion");
		const html5QrCode = new Html5Qrcode("qr-reader");
		const config = { fps: 10, qrbox: 250 };

		function onScanSuccess(decodedText) {
			console.log("QR Code détecté :", decodedText);
			qrResult.value = decodedText.replace(/[\r\n]/g, '');
			qrLogin.requestSubmit();

			html5QrCode.stop()
				.then(() => console.log("Scanner arrêté"))
				.catch(err => console.error("Erreur arrêt scanner :", err));
		}

			Html5Qrcode.getCameras()
				.then(cameras => {
					if(cameras.length > 0) {
						html5QrCode.start(cameras[0].id, config, onScanSuccess)
							.then(() => console.log("Scanner démarré"))
							.catch(err => console.error("Erreur démarrage :", err));
					} else {
						alert("Aucune caméra détectée !");
					}
				})
				.catch(err => console.error("Erreur détection caméra :", err));
	});
</script>


<?= $this->endSection() ?>
