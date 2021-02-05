<?php include '../common/header.php'?>

<h1 class="classificationHeadings"><?php echo $classification_type; ?></h1>
<?php if(isset($_SESSION['message'])){
    echo$_SESSION['message'];}
?>
<?php if(isset($animalDisplay)){
    echo $animalList;
    echo $animalDisplay;
}
?>


<?php include '../common/footer.php'?>
