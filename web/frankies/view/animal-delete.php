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
<p>Confirm Animal Deletion. This delete is permenant</p>

<form method="post" action="/frankies/animals/index.php" class="accountForms">
<div class="form-group explain">
<label for="type_name">Animal Type</label>
<input type="text" name="type_name" id="type_name" readonly <?php if(isset($animalInfo['animal_type'])) {echo "value='$animalInfo[animal_type]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_subtype">SubType</label>
<input type="text" name="animal_subtype" id="animal_subtype" readonly <?php if(isset($animalInfo['animal_subtype'])) {echo "value='$animalInfo[animal_subtype]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_name">Name</label>
<input type="text" name="animal_name" id="animal_name" readonly <?php if(isset($animalInfo['animal_name'])) {echo "value='$animalInfo[animal_name]'"; }?>>
</div>
<div class="form-group explain">
<label for="animal_notes">Notes</label>
<input type="text" name="animal_notes" id="animal_notes" readonly <?php if(isset($animalInfo['animal_notes'])) {echo "value='$animalInfo[animal_notes]'"; }?>>
</div>
<div class="form-group explain">
<input type="hidden" name="action" value="deleteAnimal">
<input type="hidden" name="animal_id" value="<?php if(isset($animalInfo['animal_id'])){ echo $animalInfo['animal_id'];}?>"> 
<input type='submit' name='submit' value='Delete Animal' title="Delete Animal">
</div>

</form>

<?php unset($_SESSION['message']);?>
<?php include '../common/footer.php' ?>