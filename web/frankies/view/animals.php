<?php include '../common/header.php' ?>

<h1 class="classificationHeadings"><?php echo $_SESSION['classification_type']; ?></h1>
<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>


<form method="post" action="/frankies/animals/index.php">
    <div class="row">
        
        <label for ="type_id">Filter Results</label>
            <?php
            if (!empty($animalList)) {
                echo $animalList;
            }
            ?>
        
            <input type="hidden" name="action" value="filterData">
            <input type="submit" name="submit" value="Filter">
        
    </div>
</form>


<?php if (isset($animalDisplay)) {
    echo $animalDisplay;
}
?>


<?php include '../common/footer.php' ?>