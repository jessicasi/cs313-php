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
$species = getSpecies();

// Build the nav list

$navList = getNavList($species);

echo "test";
?>