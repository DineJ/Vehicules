<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Détails de User</h2>
<p><strong>id:</strong> <?= $item->id ?></p>
        <p><strong>nom:</strong> <?= $item->nom ?></p>
        <p><strong>prenom:</strong> <?= $item->prenom ?></p>
        <p><strong>permission:</strong> <?= $item->permission ?></p>
        <p><strong>telephone:</strong> <?= $item->telephone ?></p>
        <p><strong>mail:</strong> <?= $item->mail ?></p>
<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>

<?= $this->endSection() ?>