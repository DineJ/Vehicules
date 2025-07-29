<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?? 'Mon Site' ?></title> <!-- Page title (fallback to "Mon Site" if $title is not set) -->

	<!-- Bootstrap CSS for styling -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	
	<style>
	/* Table header styling */
	th
	{
		background-color: grey !important;
		border-color: grey !important;
		color: white !important;
	}

	/* Pagination layout and appearance */
	.pagination
	{
		display: flex;
		justify-content: center;
		margin-top: 30px;
	}

	.pagination li
	{
		margin: 0 5px;
	}

	.pagination li a
	{
		border-radius: 5px;	/* Rounded edges */
		color: #000;		/* Text color */
		padding: 8px 16px;
		font-weight: bold;
		transition: background-color 0.3s ease;
		text-decoration: none;	/* Remove underline */
		border: none;			/* Remove border */
	}

	.pagination li a:hover
	{
		background-color: #f1f1f1;  /* Light background on hover */
	}

	.pagination .active a
	{
		border: 2px solid;	/* Highlight active page */
	}

	/* Truncate long text inside a table cell */
	.index .long-text
	{
		max-width: 250px;	 		/* Limit cell width */
		white-space: nowrap; 		/* Prevent line breaks */
		overflow: hidden;			/* Hide overflow text */
		text-overflow: ellipsis;	/* Show "..." for overflow */
		word-break: break-all;		/* Break long words if needed */
		display: table-cell;		/* Align text vertically */
		vertical-align: middle;
	}

	.show .long-text
	{
		white-space: pre-wrap;		/* Preserve whitespace and wrap text when needed */
		overflow-wrap: break-word;	/* Break long words to prevent overflow */
		word-break: break-word;		/* Allow breaking within words if necessary */
		max-width: 100%;			/* Ensure the content doesn't exceed container width */
		display: block;				/* Allows proper line breaks and spacing */
		padding: 10px;				/* Add spacing inside the element for better readability */
		background-color: #f9f9f9;	/* Optional: Light background to visually separate the text */
	}
</style>

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
