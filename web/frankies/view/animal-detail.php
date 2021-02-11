<?php include '../common/header.php'?>

<?php if(isset($_SESSION['message'])){
    echo$_SESSION['message'];}
?>
<?php if(isset($animalDisplay)){
    echo $animalDisplay;
}?>

<h2>Customer Reviews</h2>
<?php
if (!isset($_SESSION['loggedin'])) {
    echo '<p> If you\'d like to add a review, please <a href="/frankies/accounts/index.php?action=deliverLoginView" title="Login">log in here</a></p>';
} else {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
    }
    echo '<div>';
    echo '<form method="post" action="/frankies/reviews/index.php">';
    echo '<label for="screenName">Screen Name</label>';
    echo '<input type="text" name="screenName" readonly value=';
    echo $_SESSION['screenName'];
    echo '>';
    echo '<label for="review_text">Review</label>';
    echo '<textarea name="review_text" required></textarea>';
    echo '<input type="hidden" name="type_id" value=';
    echo $animal['type_id'];
    echo '>';
    echo '<input type="hidden" name="animal_id" value=';
    echo $animal['animal_id'];
    echo '>';
    echo '<input type="hidden" name="[people_id" value=';
    echo $_SESSION['clientData']['people_id'];
    echo '>';
    echo '<input type="hidden" name="action" value="newReview">';
    echo '<input type="submit" name="submit" value="Submit Review" title="Submit Review">';
    echo '</form></div>';
} 
if (isset($reviewDisplay)) {
    echo  $reviewDisplay;
};
unset($_SESSION['message']);
?>

<?php include '../common/footer.php'?>