<?php include '../common/header.php' ?>

<?php if (!$_SESSION['loggedin']) {
    header('Location: /frankies');
} ?><h1 class="classificationHeadings">Welcome <?php echo $_SESSION['clientData']['people_fname'] ?></h1>


<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
} ?>

<div class="admin-page">
<ul>
    <li><span class="account-info">Name: </span> <?php echo $_SESSION['clientData']['people_fname'] ." ". $_SESSION['clientData']['people_lname'] ?></li>
    <li><span class="account-info">Email Address:</span> <?php echo $_SESSION['clientData']['people_email'] ?></li>
</ul>
<hr>
<section>
    <h2>Account Management</h2>
    <a href='/frankies/accounts/index.php?action=mod' title="Update Account" class = "updateLink btn">Click to update account information</a>
</section>
<hr>
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
<hr>
<?php
if ($_SESSION['clientData']['people_level'] == 1) {
    echo "<section>";
    echo "<h2> Animal Management</h2>";
    echo "<p><a href='/frankies/animals/index.php' title='Animals Controller Page' class = 'updateLink'>Click to manage animal infomrmation</a></p>";
    echo "</section>";
}
?>
</div>
<?php
unset($_SESSION['message']);
?>

<?php include '../common/footer.php' ?>