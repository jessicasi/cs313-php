<?php include '../common/header.php' ?>

<h1 class="classificationHeadings"><?php echo $_SESSION['classification_type']; ?></h1>
<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<div class="divRow">
<form method="post" action="/frankies/animals/index.php">
    <div class="row ">
        <div class="col formRight">
        <label for ="type_id" id="farmLabel">Filter</label>
        </div>
        <div class="col">
            <?php
            if (!empty($animalList)) {
                echo $animalList;
            }
            ?>
        </div>
        <div class="col formLeft">
            <input type="hidden" name="action" value="filterData">
            <input type="submit" name="submit" value="Submit">
        </div>
    </div>
</form>
</div>

<p id="animal-intro">Click on an animal to see more information about it</p>
<?php if (isset($animalDisplay)) {
    echo $animalDisplay;
}
?>


<?php include '../common/footer.php' ?>