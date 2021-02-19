<?php if ($_SESSION['clientData']['people_level'] != 1) {
    header('location: /frankies/');
    exit;
}
?><?php include '../common/header.php' ?>

<?php
if ($_SESSION['clientData']['people_level'] != 1 || !$_SESSION['loggedin']) {
    header('Location: /frankies/');
}
?><h1 class="animal-man-heading">Animal Administrative</h1>
<div class="animal-man-page">
<h2>Add Animals/Types</h2>
    <!-- <ul class="animal-man-list"> -->
        <!-- <li>  -->
        <a href='/frankies/animals/index.php?action=deliverAnimalTypeView' class=" button-update man-button">Add Animal Type </a>
        <!-- </li> -->
        <!-- <li>  -->
        <a href='/frankies/animals/index.php?action=deliverAnimalView' class=" button-update man-button">Add Animal </a>
        <!-- </li> -->
    <!-- </ul> -->

    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    if (isset($typeList)) {
        echo '<h2>Update Existing Animals</h2>';
        echo '<p>Choose a type to see those animals</p>';
        echo $typeList;
    }
    ?>

    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="animalDisplay" class="animalTable"></table>

    <script src="../scripts/scripts.js"></script>
    <a href="/frankies/accounts?action=deliverAdminView" class="button-change right-side">Cancel</a>
</div>

<?php include '../common/footer.php' ?>