<?php


//This is the accounts controller

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
//require_once '../model/reviews-model.php';


//Get the list of species
$classifications = getClassifications();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'deliverLoginView':
        $pageTitle = 'Log In';
        include '../view/log-on.php';
        break;

    case 'deliverRegisterView':
        $pageTitle = 'Registration';
        include '../view/register.php';
        break;

    case 'registerUser':
        $pageTitle = 'Registration';
        //filter and store data
        $people_fname = filter_input(INPUT_POST, 'people_fname', FILTER_SANITIZE_STRING);
        $people_fname = htmlspecialchars($people_fname);
        $people_lname = filter_input(INPUT_POST, 'people_lname', FILTER_SANITIZE_STRING);
        $people_lname = htmlspecialchars($people_lname);
        $people_email = filter_input(INPUT_POST, 'people_email', FILTER_SANITIZE_STRING);
        $people_email = htmlspecialchars($people_email);
        $people_password = filter_input(INPUT_POST, 'people_password', FILTER_SANITIZE_STRING);
        $people_password = htmlspecialchars($people_password);

        $people_email = checkEmail($people_email);
        $checkedPassword = checkPassword($people_password);

        //checking to see if the email entered is already in the database
        $exisitingEmail = checkExistingEmail($people_email);

        if ($exisitingEmail) {
            $_SESSION['message'] = "<p class='errorMessage'>That email address is already in our system. Do you want to log in instead?</p>";
            include '../view/log-on.php';
            unset($_SESSION['message']);
            exit;
        }

        // Check for missing data
        if (empty($people_fname) || empty($people_lname) || empty($people_email) || empty($people_password)) {
            $_SESSION['message'] = "<p class='errorMessage'>Please provide information for all empty form fields.</p>";
            include '../view/register.php';
            unset($_SESSION['message']);
            exit;
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        //Send the data to the model
        $regOutcome = regClient($people_fname, $people_lname, $people_email, $hashedPassword);

        // Check and report the result
        if ($regOutcome === 1) {
            $_SESSION['message'] = "<p class='returnMessage'>Thanks for registering $people_fname. Please use your email and password to login.</p>";
            header('Location: /frankies/accounts/?action=login');
            exit;
        } else {
            $_SESSION['message'] = "<p>Sorry $people_fname, but the registration failed. Please try again.</p>";
            include '../view/registration.php';
            unset($_SESSION['message']);
            exit;
        }
        break;
    case 'Login':

        // Filter and store the data
        $people_email = filter_input(INPUT_POST, 'people_email', FILTER_SANITIZE_EMAIL);
        $people_email = checkEmail($people_email);

        $people_password = filter_input(INPUT_POST, 'people_password', FILTER_SANITIZE_STRING);
        $people_password = checkPassword($people_password);


        // Check for missing data
        if (empty($people_email) || empty($people_password)) {
            $_SESSION['message'] = "<p class='errorMessage'>Please provide information for all empty form fields.</p>";
            include '../view/log-on.php';
            unset($_SESSION['message']);
            exit;
        }

        // A valid password exists, proceed with the login process
        // Query the client data based on the email address
        $clientData = getClient($people_email);
        // Compare the password just submitted against
        // the hashed password for the matching client
        $hashCheck = password_verify($people_password, $clientData['people_password']);
        // If the hashes don't match create an error
        // and return to the login view
        if (!$hashCheck) {
            $_SESSION['message'] = '<p class="errorMessage">Please check your password and try again.</p>';
            include '../view/log-on.php';
            unset($_SESSION['message']);
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;
        // Remove the password from the array
        // the array_pop   function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;

        //set screen name
        $screenName = getScreenName($_SESSION['clientData']['people_fname'], $_SESSION['clientData']['people_lname']);
        $_SESSION['screenName'] = $screenName;

        //Get all reviews written by user
       // $personalReviews = getPersonalReviews($_SESSION['clientData']['people_id']);

        //if (count($personalReviews)) {
           // $_SESSION['reviewDisplay'] = buildPersonalReviewDisplay($personalReviews);
        //} else {
          //  $_SESSION['message1'] = "<p class='emptyMessage'>You haven't reviewed anything yet - head to a vehicle detail page to make your first review!</p>";
        //}

        // Send them to the admin view
        //include '../view/admin.php';  
        header('Location: /frankies/accounts');
 
        break;

    default:
        include '../view/register.php';
        break;
}
