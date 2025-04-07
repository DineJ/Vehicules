<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<div class="container mt-5">
    <h2>Détails de l'utilisateur</h2>

    <table class="table table-striped table-primary table-bordered">
        <tbody>
            <tr>
                <th>Nom</th>
                <td><?= $item->nom ?></td>
            </tr>
				<tr>
                <th>Prénom</th>
                <td><?= $item->prenom ?></td>
            </tr>
            <tr>
                <th>Admin</th>
                <td><?= $item->admin ? 'Oui' : 'Non' ?></td>
            </tr>
            <tr>
                <th>Téléphone</th>
                <td><?= $item->telephone ?></td>
            </tr>
            <tr>
                <th>Mail</th>
                <td><?= $item->mail ?></td>
            </tr>
            <tr>
                <th>Actif</th>
                <td><?= $item->actif ? 'Oui' : 'Non' ?></td>
            </tr>           
        </tbody>
    </table>

<div class="mb-3">
	<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>
</div>

<?= $this->endSection() ?>
