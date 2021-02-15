<?php


//This is the reviews controller

//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//get the main model for use as needed
require_once '../model/main-model.php';
//get the main model for use as needed
require_once '../model/animals-model.php';
//get the main model for use as needed
require_once '../model/accounts-model.php';
// Get the functions library
require_once '../library/functions.php';
//Get the reviews model
require_once '../model/reviews-model.php';


//Get the list of species
$classifications = getClassifications();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
    case 'newReview':
        //Add Review
        //Filter and store the data
        $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
        $animal_id = filter_input(INPUT_POST, 'animal_id', FILTER_SANITIZE_NUMBER_INT);
        $type_id = filter_input(INPUT_GET, 'type_id', FILTER_SANITIZE_NUMBER_INT);
        $people_id = filter_input(INPUT_POST, 'people_id', FILTER_SANITIZE_NUMBER_INT);

        //Check for missing data
        if (empty($review_text)) {
            $_SESSION['message'] = '<p class="errorMessage">Please provide information for all form fields.</p>';
            header("Location: /frankies/animals?action=information&animal_id=$animal_id");
            exit;
        }

        $reviewOutcome = newReview($review_text, $type_id, $people_id);

        //Check and report the result
        if ($reviewOutcome === 1) {
            header("Location: /frankies/animals?action=information&invId=$animal_id");
            exit;
        } else {
            $_SESSION['message'] = '<p class="errorMessage">Sorry, but the review adding failed. Please try again.</p>';
            header("Location: /phpmotors/vehicles?action=information&invId=$animal_id");
            exit;
        }
        break;
    case 'deliverEditView':
        $review_id = filter_input(INPUT_GET, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = "Update Review";
        $reviewInfo = getReviewInfo($review_id);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no reviews were found.';
            exit;
        }
        $reviewInfo['review_date'] = getReviewDate($reviewInfo['review_date']);

        $_SESSION['reviewInfo'] = $reviewInfo;

        include '../view/review-update.php';
        break;
    case 'deliverEditView':
        $review_id = filter_input(INPUT_GET, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = "Update Review";
        $reviewInfo = getReviewInfo($review_id);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no reviews were found.';
            exit;
        }
        $reviewInfo['review_date'] = getReviewDate($reviewInfo['review_date']);

        $_SESSION['reviewInfo'] = $reviewInfo;

        include '../view/review-update.php';
        break;

    case 'updateReview':
        //filter and store the data
        $review_text = filter_input(INPUT_POST, 'review_text', FILTER_SANITIZE_STRING);
        $review_id = filter_input(INPUT_POST, 'review_id', FILTER_SANITIZE_NUMBER_INT);

        //make sure  nothing is empty
        if (empty($review_text)) {
            $_SESSION['message'] = '<p> All form fields must have information.  If you are trying to delete your review you can go do so <a href="/phpmotors/reviews?action="deliverDeleteView">here</a></p>';
            $pageTitle = 'Update Review';
            include '../view/review-update.php';
            exit;
        }
        //Send data to the model

        $updateOutcome = updateReview($review_text, $review_id);
        // Check and report the result
        if ($updateOutcome === 1) {
            $_SESSION['message'] = "<p>Congratulations your review was updated successfully in the database .</p>";
            header('location: /frankies/accounts/');
            exit;
        } else {
            $_SESSION['message'] = '<p>To update a review, please make a change.</p>';
            include '../view/review-update.php';
            exit;
        }

        break;
    case 'deliverDeleteView':
        $review_id = filter_input(INPUT_GET, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $pageTitle = "Delete Review";
        $reviewInfo = getReviewInfo($review_id);
        if (count($reviewInfo) < 1) {
            $message = 'Sorry, no reviews were found.';
            exit;
        }
        $reviewInfo['review_date'] = getReviewDate($reviewInfo['review_date']);

        $_SESSION['reviewInfo'] = $reviewInfo;

        include '../view/review-delete.php';
        break;
    case 'deleteReview':
        $review_id = filter_input(INPUT_POST, 'review_id', FILTER_SANITIZE_NUMBER_INT);
        $deleteOutcome = deleteReview($review_id);
        // Check and report the result
        if ($deleteOutcome === 1) {
            $_SESSION['message'] = "<p >Congratulations your review was successfully deleted from the database .</p>";
            header("Location: /frankies/accounts?action=admin");
            exit;
        } else {
            $_SESSION['message'] = '<p >Error: your review was not deleted.</p>';
            include '../view/review-delete.php';
            exit;
        }
        break;

    default:
        break;
}
