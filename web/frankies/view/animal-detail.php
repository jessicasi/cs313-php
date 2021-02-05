<?php include '../common/header.php'?>

<?php if(isset($_SESSION['message'])){
    echo$_SESSION['message'];}
?>
<?php if(isset($animalDisplay)){
    echo $animalDisplay;
}
?>

<?php include '../common/footer.php'?>