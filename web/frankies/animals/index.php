<?php


//This is the animal controller

//Create or access a Session
session_start();

//Get the database connection file
require_once '../library/connections.php';
//get the main model for use as needed
require_once '../model/main-model.php';
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
        $classificationType = filter_input(INPUT_GET,'classification_type', FILTER_SANITIZE_STRING);
        $pageTitle =  $classificationType;
        $animals = getAnimalsByType($classificationType);
        break;
    default:
        include 'view/home.php';
        break;
}