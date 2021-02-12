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
//Get accounts model
require_once '../model/accounts-model.php';
//Get the reviews model
require_once '../model/reviews-model.php';


//Get the list of species
$classifications = getClassifications();
$types = getAllTypes();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {

    case 'classification':
        $classification_type = filter_input(INPUT_GET, 'classification_type', FILTER_SANITIZE_STRING);
        $pageTitle =  $classification_type;
        $_SESSION['classification_type'] = $classification_type;
        $animals = getAnimalsByType($classification_type);

        if (!count($animals)) {
            $_SESSION['message'] = "<p class='errorMessage'>Sorry, no $classification_type could be found.</p>";
        } else {
            $animalDisplay = buildAnimalDisplay($animals);
            $typeList = getTypes($classification_type);
            $animalList = buildAnimalList($typeList);
        }

        include '../view/animals.php';
        break;

    case 'information':
        $animal_id = filter_input(INPUT_GET, 'animal_id', FILTER_SANITIZE_NUMBER_INT);
        $animal = getAnimalDetails($animal_id);
        if (isset($animal['animal_type']) && isset($animal['name'])) {
            $pageTitle = "$animal[animal_type] $animal[name]";
        }
        if (count($animal) < 1) {
            $message = 'Sorry, no animal information could be found.';
        } else {
            $animalDisplay = buildDetailDisplay($animal);
        }
        $reviews = getReviews($animal['type_id']);
        if (count($reviews)) {
            $reviewDisplay = buildReviewDisplay($reviews);
        }

        include '../view/animal-detail.php';
        break;

    case 'filterData':
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_STRING);

        //check for missing data
        if (empty($type_id)) {
            $_SESSION['message'] = "Choose an animal to filter results by";
            include '../view/animals.php';
            exit;
        }
        $filteredAnimals = getFilteredAnimals($type_id);
        $animalDisplay = buildAnimalDisplay($filteredAnimals);
        $typeList = getTypes($_SESSION['classification_type']);
        $animalList = buildAnimalList($typeList);

        include '../view/animals.php';

        break;

    case 'getAnimalTypes':
        // Get the classificationID 
        $type_id = filter_input(INPUT_GET, 'type_id', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationID from the DB 
        $AnimalArray = getFilteredAnimals($type_id);
        // Convert the array to a JSON object and send it back 
        echo json_encode($AnimalArray);
        break;

    case 'mod':
        $animal_id = filter_input(INPUT_GET, 'animal_id', FILTER_VALIDATE_INT);
        $animalInfo = getAnimalInfo($animal_id);
        if (count($animalInfo) < 1) {
            $message = 'Sorry, no animal information could be found.';
        }
        if (isset($animal_info['animal_name'])) {
            $pageTitle = "Modify $animal_info[animal_name])";
        } 
        include '../view/animal-update.php';
        break;
    default:

        $typeList = buildTypeList($types);

        include '../view/animal-man.php';
        break;
}
