<h1>Checking véhicule</h1>

<p>
	Véhicule :
	<?= $vehicule->plaque ?>
</p>

<form method="post">

	<label>État du véhicule</label>
	<textarea name="commentaire"></textarea>

	<button type="submit">
		Valider le checking
	</button>

</form>