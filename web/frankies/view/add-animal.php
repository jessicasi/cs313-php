<?php include '../common/header.php' ?>
<?php
if ($_SESSION['clientData']['people_level'] != 1 || !$_SESSION['loggedin']) {
    header('Location: /frankies/');
}?>
<?php

//Build Classification List
$classificationList = '<select name="classification_id" class="form-control" required>';
foreach ($classifications as $classification){
    $classificationList .= "<option value='$classification[classification_id]'";
    if(isset($classification_id)){
        if($classification['classification_id'] === $classification_id){
        $classificationList .= ' selected ';
        }
    } elseif(isset($animalInfo['classification_id'])){
        if($classification['classification_id'] === $animalInfo['classification_id']){
            $classificationList .= ' selected ';
        }
    }
     $classificationList.= ">$classification[classification_type]</option>";
}
$classificationList .= '</select>';

//Build Type List
$typeList = '<select name="type_id" class="form-control" required>';
foreach ($types as $type){
    $typeList .= "<option value='$type[type_id]$type[type_name]'";
    if(isset($type_id)){
        if($type['type_id'] === $type_id){
            $typeList .= ' selected ';
        }
    } elseif(isset($animalInfo['type_id'])){
        if($type['type_id'] === $animalInfo['type_id']){
            $typeList .= ' selected ';
        }
    }
    $typeList.= ">$type[type_name]</option>";
}
$typeList .= '</select>';

?><h1>Add Animal</h1>
<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<div class="add-animal-page">
<p>* All Fields are Required</p>
<form method="post" action="/frankies/animals/index.php" class="accountForms" enctype="multipart/form-data">
<div class="form-group explain">
<label>*Classification</label>
        <?php
        if (!empty($classificationList)) {
            echo $classificationList;
        }
        ?>
</div>
<div class="form-group explain">
<label>*Type</label>
        <?php
        if (!empty($typeList)) {
            echo $typeList;
        }
        ?>
</div>
<div class="form-group explain">
<label>*Breed</label>
<input type="text" name="animal_subtype" id="animal_subtype" class="form-control"
        value='<?php if (isset($animalInfo['animal_subtype'])) { echo $animalInfo['animal_subtype'];
        }?>' required title="Required">
</div>
<div class="form-group explain">
<label>*Name</label>
<input type="text" name="animal_name" id="animal_name" class="form-control"
        value='<?php if (isset($animalInfo['animal_name'])) { echo $animalInfo['animal_name'];
        }?>' required title="Required">
</div>
<div class="form-group explain">
<label>*Age</label>
<input type="number" name="animal_age" id="animal_age" class="form-control"
        value='<?php if (isset($animalInfo['animal_age'])) { echo $animalInfo['animal_age'];
        }?>' required title="Required">
</div>
<div class="form-group explain">
<label>*Notes</label>
<textarea name="animal_notes" id="animal_notes" class="form-control" required title="Required">
<?php if (isset($animalInfo['animal_notes'])) { echo $animalInfo['animal_notes'];}?></textarea>
</div>
<div class="form-group explain">
<label>*Upload Image</label>
<input type="file" name="file1" class="form-control">
</div>
<div class="form-group explain">
<input type="hidden" name="action" value="addAnimal">
<input type='submit' name="submit" value="Add Animal" class="button-update">
<a href="/frankies/animals" class="button-change">Cancel</a>
</div>

</form>

</div>

<?php unset($_SESSION['message']);?>
<?php include '../common/footer.php' ?>