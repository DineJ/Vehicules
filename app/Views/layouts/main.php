<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mon Site' ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    
    <style>
	th {
		background-color: grey !important;
		border-color: grey !important;
		color: white !important;
	}

	.pagination {
		display: flex;
		justify-content: center;
		margin-top: 30px;
	}

	.pagination li {
		margin: 0 5px;
	}

	.pagination li a {
		border-radius: 5px;  /* Légèrement arrondi */
		color: #000;  /* Texte en noir */
		padding: 8px 16px;
		font-weight: bold;
		transition: background-color 0.3s ease;
		text-decoration: none;  /* Enlever le soulignement */
		border: none;  /* Supprimer la bordure autour des chiffres */
	}

	.pagination li a:hover {
		background-color: #f1f1f1;  /* Légère teinte de fond au survol */
	}

	.pagination .active a {
		border: 2px solid;
	}
	</style>
</head>
<body>
    <div class="container mt-5">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>
