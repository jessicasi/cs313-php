<?php include '../common/header.php' ?>
<?php
if ($_SESSION['clientData']['people_level'] != 1 || !$_SESSION['loggedin']) {
    header('Location: /frankies/');
}?><h1>Delete Animal</h1>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>
<div class="delete-animal-page">
<p>** Animal deletion is permenant and cannot be undone **</p>

<form method="post" action="/frankies/animals/index.php" class="accountForms">
<div class="form-group explain">
<label for="type_name">Animal Type</label>
<input type="text" name="type_name" id="type_name" class="form-control" readonly <?php if(isset($animalInfo['animal_type'])) {echo "value='$animalInfo[animal_type]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_subtype">SubType</label>
<input type="text" name="animal_subtype" class="form-control" id="animal_subtype" readonly <?php if(isset($animalInfo['animal_subtype'])) {echo "value='$animalInfo[animal_subtype]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_name">Name</label>
<input type="text" name="animal_name" class="form-control" id="animal_name" readonly <?php if(isset($animalInfo['animal_name'])) {echo "value='$animalInfo[animal_name]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_notes">Notes</label>
<textarea type="text" name="animal_notes" class="form-control" id="animal_notes" readonly> <?php if(isset($animalInfo['animal_notes'])) {echo $animalInfo['animal_notes']; }?></textarea>
</div>
<div class="form-group explain">
<input type="hidden" name="action" value="deleteAnimal">
<input type="hidden" name="animal_id" value="<?php if(isset($animalInfo['animal_id'])){ echo $animalInfo['animal_id'];}?>"> 
<input type='submit' name='submit' value='Delete Animal' title="Delete Animal" class="button-update">
<a href="/frankies/animals" class="button-update">Cancel</a>
</div>

</form>
</div>

<?php unset($_SESSION['message']);?>
<?php include '../common/footer.php' ?>