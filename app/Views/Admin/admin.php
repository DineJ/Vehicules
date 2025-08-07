<?= $this->extend('layouts/main') ?> <!-- Extend the base layout -->
<?= $this->section('content') ?> <!-- Start the main content section -->



 <!-- Display a number ofitems equal to paginate -->
<?php $count = 0;

function paginateNumber(&$count, $items) {
    $count++;
    if ($count == count($items)) {
        $count = 0;
        return true;
    }
    return false;
}
?>




<!-- Main content -->
<div class="container mt-4">
	<h2 style="text-align: center;">Bienvenue sur l’espace admin</h2>
</div>

</br>

<div class="table-responsive">
	<h4 class="centerTitle"> Adresse IP Bannies </h4>
	<table class="table table-striped table-bordered mt-3">
		<tbody>
			<!-- Test if atleast one ip is banned -->
			<?php if (empty($ip)) { ?>

				<!-- None banned IP -->
				<tr>
					<td class="labelAlign">Aucune adresse IP bannie</td>
				</tr>
			<?php
			}
			else
			{
			?>
				<!-- Display banned ip -->
				<?php foreach ($ip as $ips): ?>
					<tr>
						<td class="td-hidden table15pourcent">Adresse IP</td>
						<td data-label="Adresse Ip"><?= esc($ips->adresse_ip) ?></td>
						<td data-label="Action" class="actionend">

							<form method="post" action="<?= site_url('Ip/update/'.$ips->id) ?>">
								<!-- Enabled ip button -->
								<input type="hidden" name="nb_echec" id="nb_echec" value="0"?>

								<!-- Redirection button -->
								<input type="hidden" name="redirect_url" value="<?= current_url(); ?>">
								<button type="submit" class="btn btn-danger btn-sm"> Rétablir IP </button>
							</form>
						</td>
					</tr>

					<?php
					if (paginateNumber($count, $items))
					{
						break;
					}
					?>

				<?php endforeach; ?>
			<?php
			}
			?>
		</tbody>
	</table>

	<!-- Redirection button -->
	<a href="<?= site_url('Ip') ?>" class="btn btn-secondary">Retour vers IP</a>

	</br></br>

	<h4 class="centerTitle"> Utilisateur Bannis </h4>
	<table class="table table-striped table-bordered mt-3">
		<tbody>
			<!-- Test if atleast one user is banned -->
			<?php if (empty($user)) { ?>

				<!-- None banned user -->
				<tr>
					<td class="labelAlign">Aucun utilisateur banni</td>
				</tr>
			<?php
			}
			else
			{
			?>
				<!-- Display banned user -->
				<?php foreach ($user as $users): ?>
					<tr>
						<td data-label="Nom" class="table15pourcent"><?= esc($users->nom) ?></td>
						<td data-label="Prénom"><?= esc($users->prenom) ?></td>
						<td data-label="Action" class="actionend">

							<form method="post" action="<?= site_url('User/update/'.$users->id) ?>">
								<!-- Enabled account button -->
								<input type="hidden" name="actif" id="actif" value="1">

								<!-- Redirection button -->
								<input type="hidden" name="redirect_url" value="<?= current_url(); ?>">
								<button type="submit" class="btn btn-danger btn-sm"> Rétablir utilisateur </button>
							</form>
						</td>
					</tr>

					<?php
					if (paginateNumber($count, $items))
					{
						break;
					}
					?>

				<?php endforeach; ?>
			<?php
			}
			?>
		<t/body>
	</table>

	<!-- Redirection button -->
	<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour vers utilisateur</a>
</div>

<?= $this->endSection() ?> <!-- End the content section -->