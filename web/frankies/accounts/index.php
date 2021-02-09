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
//require_once '../model/accounts-model.php';
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

        break;

    default:
        include '../view/register.php';
        break;
}
