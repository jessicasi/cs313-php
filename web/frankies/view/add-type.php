<?php include '../common/header.php' ?>
<?php
if ($_SESSION['clientData']['people_level'] != 1 || !$_SESSION['loggedin']) {
    header('Location: /frankies/');
}?><h1>Add Animal Type</h1>
<?php
//Build Classification List
$classificationList = '<select name="classification_id" class="form-select" required>';
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
$classificationList .= '</select>';?>

<?php
if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<form method="post" action="/frankies/animals/index.php" class="accountForms">
<div class="form-group explain">
<label>*Classification</label>
        <?php
        if (!empty($classificationList)) {
            echo $classificationList;
        }
        ?>
</div>
<div class="form-group explain">
<label for="type_name">Type Name</label>
<input type="text" name="type_name" id="type_name", placeholder="Type Name" required class="form-control">
</div>
<div class="form-group explain">
<input type="hidden" name="action" value="addType">
<input type='submit' name='submit' value='Add Type' title="Add Type" class="button-update">
<a href="/frankies/animals" class="button-change">Cancel</a>
</div>

<?php unset($_SESSION['message']);?>
<?php include '../common/footer.php' ?>