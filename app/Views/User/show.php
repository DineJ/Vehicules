<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>Détails de User</h2>
<p><strong>id:</strong> <?= $item->id ?></p>
<p><strong>nom:</strong> <?= $item->nom ?></p>
<p><strong>prenom:</strong> <?= $item->prenom ?></p>
<p><strong>admin:</strong> <?= $item->admin ?></p>
<p><strong>telephone:</strong> <?= $item->telephone ?></p>
<p><strong>mail:</strong> <?= $item->mail ?></p>
<p><strong>actif:</strong> <?= $item->actif ?></p>
<a href="<?= site_url('User') ?>" class="btn btn-secondary">Retour</a>

<?= $this->endSection() ?>
