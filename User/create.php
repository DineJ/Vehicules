<?= $this->extend('layouts/main') ?>
<?= $this->section('content') ?>

<h2>User - <?= $title ?></h2>

<form method="post" action="<?= site_url('User/store') ?>" onsubmit="return validateForm()">

	<label>nom</label>
	<input type='text' onchange="setUpper(document.getElementById('nom'));" pattern="^[a-zA-Z]+([\- ]?[a-zA-Z]+)*$" id='nom' name='nom' value='<?= isset($item) ? $item->nom : '' ?>' class='form-control' required>
	
	<label>prenom</label>
	<input type='text' onchange="setUpper(document.getElementById('prenom'));" pattern="[a-zA-Z]+([\- ]?[a-zA-Z]+)*" id='prenom' name='prenom' value='<?= isset($item) ? $item->prenom : '' ?>' class='form-control' required>
	
	<label>permission</label>
	<input type='number' min="0" max="1" id='permission' name='permission' value='<?= isset($item) ? $item->permission : '' ?>' class='form-control' required>
	
	<label>telephone</label>
	<input type='tel' pattern="[0-9]{10}" id='telephone' name='telephone' value='<?= isset($item) ? $item->telephone : '' ?>' class='form-control' required>
	
	<label>mail</label>
	<input type='email' pattern="^[a-z0-9]+([_\-\.]{1}[a-z0-9]+)*@[a-z]+\.[a-z]{2,3}$" id='mail' name='mail' value='<?= isset($item) ? $item->mail : '' ?>' class='form-control' required>

    <button type="submit" class="btn btn-primary mt-3">Enregistrer</button>
</form>

<a href="<?= site_url('User') ?>" class="btn btn-secondary mt-3">Retour</a>

<script>
function setUpper(element) {
	element.value=element.value.toUpperCase();
}

function validateForm() {
    let nom = document.getElementById('nom');
if (nom.value.trim() === '') {
    alert('Le champ nom est obligatoire.');
    nom.focus();
    return false;
}
let prenom = document.getElementById('prenom');
if (prenom.value.trim() === '') {
    alert('Le champ prenom est obligatoire.');
    prenom.focus();
    return false;
}
let permission = document.getElementById('permission');
if (permission.value.trim() === '') {
    alert('Le champ permission est obligatoire.');
    permission.focus();
    return false;
}
let telephone = document.getElementById('telephone');
if (telephone.value.trim() === '') {
    alert('Le champ telephone est obligatoire.');
    telephone.focus();
    return false;
}
let mail = document.getElementById('mail');
if (mail.value.trim() === '') {
    alert('Le champ mail est obligatoire.');
    mail.focus();
    return false;
}

    return true;
}
</script>

<?= $this->endSection() ?>
