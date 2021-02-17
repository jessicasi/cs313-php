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
    <ul class="animal-man-list">
        <li> <a href='/frankies/animals/index.php?action=deliverAnimalTypeView' class="animal-man-link">Add Animal Type </a></li>
        <li> <a href='/frankies/animals/index.php?action=deliverAnimalView' class="animal-man-link">Add Animal </a></li>
    </ul>

    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    if (isset($typeList)) {
        echo '<h2 class="ctr">Animals By Type</h2>';
        echo '<p class="ctr">Choose a type to see those animals</p>';
        echo $typeList;
    }
    ?>

    <noscript>
        <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
    </noscript>
    <table id="animalDisplay" class="animalTable"></table>

    <script src="../scripts/scripts.js"></script>

</div>

<?php include '../common/footer.php' ?>