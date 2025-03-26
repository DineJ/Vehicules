<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Liste des Users</h2>
<a href="<?= site_url('User/create') ?>" class="btn btn-success">Ajouter</a>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th>nom</th>
            <th>prenom</th>
            <th>telephone</th>
            <th>mail</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
			<td><?= $item->nom ?></td>
            <td><?= $item->prenom ?></td>
			<td><?= $item->telephone ?></td>
			<td><?= $item->mail ?></td>
            <td>
                <a href="<?= site_url('User/show/'.$item->id) ?>" class="btn btn-info">Voir</a>
                <a href="<?= site_url('User/edit/'.$item->id) ?>" class="btn btn-warning">Modifier</a>
                <a href="<?= site_url('User/delete/'.$item->id) ?>" class="btn btn-danger" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $pager->links() ?>

<?= $this->endSection() ?>
