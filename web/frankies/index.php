<?php

//This is the main controller

//Create or access a Session
session_start();

//Get the database connection file
require_once 'library/connections.php';
//get the main model for use as needed
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';


//Get the list of species
$classifications = getClassifications();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    default:
        include 'view/home.php';
        break;
}

unset($_SESSION['message']);


?>