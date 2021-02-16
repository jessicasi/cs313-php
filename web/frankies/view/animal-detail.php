<?php include '../common/header.php' ?>

<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>
<div class="animal-detail-display">
<?php if (isset($animalDisplay)) {
    echo $animalDisplay;
} ?>

<hr>
<h2>Customer Reviews</h2>
<?php
if (!isset($_SESSION['loggedin'])) {
    echo '<p> If you\'d like to add a review, please <a href="/frankies/accounts/index.php?action=deliverLoginView" title="Login">log in here</a></p>';
} else {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    echo '<div>';
    echo '<form method="post" action="/frankies/reviews/index.php" class="accountForms">';
    echo '<div class="form-group explain">';
    echo '<label for="screenName">Screen Name</label>';
    echo '<input type="text" name="screenName" class="form-control" readonly value=';
    echo $_SESSION['screenName'];
    echo '>';
    echo '</div><div class="form-group explain">';
    echo '<label for="review_text">Review</label>';
    echo '<textarea  class="form-control" name="review_text" required></textarea>';
    echo ' </div>';
    echo '<input type="hidden" name="type_id" value=';
    echo $animal['type_id'];
    echo '>';
    echo '<input type="hidden" name="animal_id" value=';
    echo $animal['animal_id'];
    echo '>';
    echo '<input type="hidden" name="people_id" value=';
    echo $_SESSION['clientData']['people_id'];
    echo '>';
    echo '<input type="hidden" name="action" value="newReview">';
    echo '<div class="form-group explain">';
    echo '<input type="submit" name="submit" value="Submit Review" title="Submit Review">';
    echo '</div>';
    echo '</form></div>';
}
if (isset($reviewDisplay)) {
    echo  $reviewDisplay;
};
unset($_SESSION['message']);
?>
</div>

<?php include '../common/footer.php' ?>