<?php include '../common/header.php' ?>

<h1 class="classificationHeadings"><?php echo $classification_type; ?></h1>
<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>

<div class="formbox">
    <form method="post" action="/frankies/animals">
        <label>Filter Results</label>
        <?php
        if (!empty($animalList)) {
            echo $animalList;
        }
        ?>
        <br>
        <input type="hidden" name="action" value="filterData">
        <input type="submit" name="submit" value="Filter">
    </form>
</div>

<?php if (isset($animalDisplay)) {
    echo $animalDisplay;
}
?>


<?php include '../common/footer.php' ?>