<?php


//This is the animal controller

//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//get the main model for use as needed
require_once '../model/main-model.php';
//get the main model for use as needed
require_once '../model/animals-model.php';
// Get the functions library
require_once '../library/functions.php';


//Get the list of species
$classifications = getClassifications();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'classification':
        $classification_type = filter_input(INPUT_GET,'classification_type', FILTER_SANITIZE_STRING);
        $pageTitle =  $classification_type;
        $animals = getAnimalsByType($classification_type);

        if(!count($animals)) {
            $_SESSION['message'] = "<p class='errorMessage'>Sorry, no $classification_type could be found.</p>";
        }else {
            $animalDisplay = buildAnimalDisplay($animals);
        }

        include '../view/animals.php';
        break;
    default:
        include 'view/home.php';
        break;
}