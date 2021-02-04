<?php


//This is the animal controller

//Create or access a Session
session_start();

//Get the database connection file
require_once 'library/connections.php';
//get the main model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';


//Get the list of species
$species = getSpecies();

// Build the nav list

$navList = getNavList($species);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'species':
        $animaltype = filter_input(INPUT_GET,'speciesType', FILTER_SANITIZE_STRING);
        $pageTitle = $speciesType;
        $animals = getAnimalsByType($speciesType);
        break;
    default:
        include 'view/home.php';
        break;
}