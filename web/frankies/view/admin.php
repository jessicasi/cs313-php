<?php include '../common/header.php' ?>

<?php if (!$_SESSION['loggedin']) {
    header('Location: /frankies');
} ?><h1>Welcome <?php echo $_SESSION['clientData']['peoplefname'] ?></h1>


<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
} ?>

<ul>
    <li>Name: <?php echo $_SESSION['clientData']['people_fname'] ." ". $_SESSION['clientData']['people_lname'] ?></li>
    <li>Email Address: <?php echo $_SESSION['clientData']['people_email'] ?></li>
</ul>
<hr>
<section>
    <h2>Account Management</h2>
    <p>Use the below link to update your account information:</p>
    <a href='/frankies/accounts/index.php?action=mod' title="Update Account">Update Account Information</a>
</section>





<?php
unset($_SESSION['message']);
?>

<?php include '../common/footer.php' ?>