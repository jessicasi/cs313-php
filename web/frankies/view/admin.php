<?php include '../common/header.php' ?>

<?php if (!$_SESSION['loggedin']) {
    header('Location: /frankies');
} ?><h1>Welcome <?php echo $_SESSION['clientData']['people_fname'] ?></h1>


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
    <a href='/frankies/accounts/index.php?action=mod' title="Update Account" class = "updateLink">Update Account Information</a>
</section>

<section class="manageReviews">
<h2 class="accountHeadings">Manage Your Product Reviews</h2><?php
if (isset($_SESSION['message1'])) {
    echo $_SESSION['message1'];
}
?>
<?php
if (isset($_SESSION['reviewDisplay'])){
    echo $_SESSION['reviewDisplay'];
}
?>

</section>

<?php
if ($_SESSION['clientData']['people_level'] == 1) {
    echo "<section>";
    echo "<h2> Animal Management</h2>";
    echo "<p>Use the below link to manage animals</p>";
    echo "<p><a href='/frankies/animals/index.php' target='_blank' title='Animals Controller Page'>Animal Management</a></p>";
    echo "</section>";
}
?>
<?php
unset($_SESSION['message']);
?>

<?php include '../common/footer.php' ?>