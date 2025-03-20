<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>User - <?= $title ?></h2>
<form method="post" action="<?= site_url('User/update/<?= $item->id ?>') ?>">
    <label>id</label><input type='text' name='id' value='<?= isset($item) ? $item->id : '' ?>' class='form-control'>
            <label>nom</label><input type='text' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control'>
            <label>prenom</label><input type='text' name='prenom' value='<?= isset($item) ? $item->prenom : '' ?>' class='form-control'>
            <label>permission</label><input type='text' name='permission' value='<?= isset($item) ? $item->permission : '' ?>' class='form-control'>
            <label>telephone</label><input type='text' name='telephone' value='<?= isset($item) ? $item->telephone : '' ?>' class='form-control'>
            <label>mail</label><input type='text' name='mail' value='<?= isset($item) ? $item->mail : '' ?>' class='form-control'>
    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>
<a href="<?= site_url('User') ?>" class="btn btn-secondary mt-3">Retour</a>

<?= $this->endSection() ?>