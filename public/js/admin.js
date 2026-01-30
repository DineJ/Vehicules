function webcam()
{
	const qrReader = document.getElementById("qr-reader");
	const qrLogin = document.getElementById("form-login");
	const qrResult = document.getElementById("clef_connexion");
	const html5QrCode = new Html5Qrcode("qr-reader");
	const config = { fps: 10, qrbox: 250 };

	Html5Qrcode.getCameras()
	.then(cameras => {
		if (cameras.length > 0)
		{
			html5QrCode.start({facingMode: "environment"}, config, (decodedText) => {
				console.log("QR Code détecté :", decodedText);

				qrResult.value = decodedText.replace(/[\r\n]/g, '');
				qrLogin.requestSubmit();

				html5QrCode.stop()
				.then(() => console.log("Scanner arrêté"))
				.catch(err => console.error("Erreur arrêt scanner :", err));
			})
			.then(() => console.log("Scanner démarré"))
			.catch(err => console.error("Erreur démarrage :", err));
		} 
		else
		{
			alert("Aucune caméra détectée !");
		}
	})
	.catch(err => console.error("Erreur détection caméra :", err));
}

// Call function
webcam();
