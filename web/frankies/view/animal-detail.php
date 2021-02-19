<?php include '../common/header.php' ?>

<?php if (isset($_SESSION['message'])) {
    echo $_SESSION['message'];
}
?>
<div class="animal-detail-display">
    <?php if (isset($animalDisplay)) {
        echo $animalDisplay;
    } ?>
    <div class="contact-animal-form">
    <h3>Contact Frankies's Farm regarding <span class="animal-name"><?php echo $animal['animal_name']; ?></span></h3>
    <div class="form-group explain">
        <form action="mailto:frankie@frankiesfarm.com" method="post" enctype="text/plain">
            <input type="hidden" name="Animal Name" value="<?php echo $animal['animal_name']?>">
            <input type="hidden" name="Animal ID (for office purposes only)" value="<?php echo $animal['animal_id']?>">
            <label for="name">* Name</label>
            <input type="text" class="form-control" name="Name" value='<?php if (isset($_SESSION['clientData']['people_fname'])) {echo $_SESSION['clientData']['people_fname'] . " ". $_SESSION['clientData']['people_lname'];} ?>' required title="Required" placeholder="Name">
            <label for="email">* Email</label>
            <input type="email" class="form-control" name="Email" id="people_email" value='<?php if (isset($_SESSION['peopleData']['people_email'])) {
             echo $_SESSION['peopleData']['people_email'];} ?>' placeholder="Email Address" required title="Required">
            <label for="comment">* Comment</label>
            <textarea name="Comments" class="form-control" required title="Required"></textarea>
            <input type="submit" value="Send" class="button-update">
            <input type="reset" value="Reset"  class="button-update">
            <a href="/frankies/animals" class="button-update">Cancel</a>
        </form>
    </div>
    </div>
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