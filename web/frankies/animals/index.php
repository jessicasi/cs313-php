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
//Get the uploads model
require_once '../model/uploads-model.php';


//Get the list of species
$classifications = getClassifications();
$types = getAllTypes();

// Build the nav list

$navList = getNavList($classifications);

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}


/* * ****************************************************
* Variables for use with the Image Upload Functionality
* **************************************************** */
// directory name where uploaded images are stored
$image_dir = '/frankies/images/animals';
// The path is the full path from the server root
$image_dir_path = $_SERVER['DOCUMENT_ROOT'] . $image_dir;
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
        $animal_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $animalInfo = getAnimalInfo($animal_id);
        if (count($animalInfo) < 1) {
            $message = 'Sorry, no animal information could be found.';
        }
        $classificationList = buildClassSelect($classifications);
        $typeList = buildTypeList($types);


        if (isset($animal_info['animal_name'])) {
            $pageTitle = "Modify $animal_info[animal_name])";
        }
        include '../view/animal-update.php';
        break;

    case 'updateAnimal':
        // Filter and store the data
        $classification_id = filter_input(INPUT_POST, 'classification_id', FILTER_SANITIZE_NUMBER_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_NUMBER_INT);
        $animal_name = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_STRING);
        $animal_type = filter_input(INPUT_POST, 'animal_type', FILTER_SANITIZE_STRING);
        $animal_age = filter_input(INPUT_POST, 'animal_age', FILTER_SANITIZE_NUMBER_INT);
        $animal_notes = filter_input(INPUT_POST, 'animal_notes', FILTER_SANITIZE_STRING);
        //$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        //$invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        $animal_id = filter_input(INPUT_POST, 'animal_id', FILTER_SANITIZE_NUMBER_INT);
     

        //Filter through array created to find classification ID

        // Check for missing data
        if (empty($animal_name) || empty($animal_age) || empty($animal_notes || empty( $animal_type))) {
            $_SESSION['message'] = '<p >Please provide information for all form fields.</p>';
            $pageTitle = 'Add Vehicle';
            include '../view/animal-update.php';
            exit;
        }
        if (empty($classification_id)) {
            $_SESSION['message'] = '<p>Classification error.</p>';
            include '../view/animal-update.php';
            exit;
        }

        if (empty($type_id)) {
            $_SESSION['message'] = '<p>Type error.</p>';
            include '../view/animal-update.php';
            exit;
        }
        // Send the data to the model

        //Temporary variable change for the image and thumnail
        //$invImage = '../images/vehicles/no-image.png';
        //$invThumbnail = '../images/vehicles/no-image.png';

        $updateOutcome = updateAnimal($classification_id, $type_id,  $animal_type, $animal_name, $animal_age, $animal_notes, $animal_id);

        // Check and report the result
        if ($updateOutcome === 1) {
            $_SESSION['message'] = "<p>Congratulations your Animal was updated successfully in the database .</p>";
            header('location: /frankies/animals/');
            exit;
        } else {
            $_SESSION['message'] = '<p>Sorry, but the animal update failed. Please try again.</p>';
            include '../view/animal-update.php';
            exit;
        }
        break;
    case 'del':
        $animal_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $animalInfo = getAnimalInfo($animal_id);
        if (count($animalInfo) < 1) {
            $message = 'Sorry, no animal information could be found.';
        }

        if (isset($animal_info['animal_name'])) {
            $pageTitle = "Modify $animal_info[animal_name])";
        }
        include '../view/animal-delete.php';
        break;
    case 'deleteAnimal':
        // Filter and store the data
        $animal_name = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_STRING);
        $animal_age = filter_input(INPUT_POST, 'animal_age', FILTER_SANITIZE_NUMBER_INT);
        // $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
        $animal_id = filter_input(INPUT_POST, 'animal_id', FILTER_SANITIZE_NUMBER_INT);

        // Send the data to the model

        $deleteOutcome = deleteAnimal($animal_id);

        // Check and report the result
        if ($deleteOutcome === 1) {
            $_SESSION['message'] = "<p'>Congratulations your Animal was successfully deleted from the database .</p>";
            header('location: /frankies/animals/');
            exit;
        } else {
            $_SESSION['message'] = '<p>Error: Animal was not deleted.</p>';
            header('location: /frankies/animals/');
            exit;
        }
        break;
    case 'deliverAnimalTypeView':
        $pageTitle = 'Add Type';
        include '../view/add-type.php';
        break;
    case 'deliverAnimalView':
        $pageTitle = 'Add Animal';
        include '../view/add-animal.php';
        break;
    case 'addAnimal':
        // Filter and store the data
        $classification_id = filter_input(INPUT_POST, 'classification_id', FILTER_SANITIZE_NUMBER_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_SANITIZE_NUMBER_INT);
        $animal_name = filter_input(INPUT_POST, 'animal_name', FILTER_SANITIZE_STRING);
        $animal_age = filter_input(INPUT_POST, 'animal_age', FILTER_SANITIZE_NUMBER_INT);
        $animal_notes = filter_input(INPUT_POST, 'animal_notes', FILTER_SANITIZE_STRING);
        $animal_subtype = filter_input(INPUT_POST, 'animal_subtype', FILTER_SANITIZE_STRING);
        $img_name = $_FILES['file1']['name'];

        
        //$invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
        //$invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
        
        // Check for missing data
        if (empty($animal_name) || empty($animal_age) || empty($animal_notes)) {
            $_SESSION['message'] = '<p >Please provide information for all form fields.</p>';
            $pageTitle = 'Add Vehicle';
            include '../view/animal-update.php';
            exit;
        }
        if (empty($classification_id)) {
            $_SESSION['message'] = '<p>Classification error.</p>';
            include '../view/animal-update.php';
            exit;
        }

        if (empty($type_id)) {
            $_SESSION['message'] = '<p>Type error.</p>';
            include '../view/animal-update.php';
            exit;
        }
        // Send the data to the model

        //Temporary variable change for the image and thumnail
        //$invImage = '../images/vehicles/no-image.png';
        //$invThumbnail = '../images/vehicles/no-image.png';

        $animal_type = getTypeName($type_id);
        $animal_id = addAnimal($animal_type['type_name'],$animal_subtype,$animal_name, $animal_age, $animal_notes, $type_id, $classification_id );

        // Check and report the result
        if($animal_id) {
            $imageCheck = checkExistingImage($img_name);
        if ($imageCheck) {
            $message = '<p">An image by that name already exists.</p>';
        } elseif (empty($classification_id) || empty($img_name)) {
            $message = '<p>You must select an animal and image file for the animal.</p>';
        } else {
            // Upload the image, store the returned path to the file
            $img_path = uploadFile('file1');

            // Insert the image information to the database, get the result
            $result = storeImages($img_path, $animal_id,$img_name, $classification_id);

            // Set a message based on the insert result
            if ($result) {
                $message = '<p class="returnMessage">The upload succeeded.</p>';
            } else {
                $message = '<p class="errorMessage">Sorry, the upload failed.</p>';
            }
        }
            $_SESSION['message'] = "<p'>Congratulations your Animal was added successfully to the database .</p>";
            include '../view/add-animal.php';
            unset($_SESSION['message']);
            exit;
        } else {
            $_SESSION['message'] = '<p">Sorry, but the animal adding failed. Please try again.</p>';
            include '../view/animal-man.php';
            unset($_SESSION['message']);
            exit;
        }

        break;

    case 'addType':
        $pageTitle = 'Add Type';
        //Add Classification Controls
        // Filter and store the data
        $classification_id = filter_input(INPUT_POST, 'classification_id', FILTER_SANITIZE_NUMBER_INT);
        $type_name = filter_input(INPUT_POST, 'type_name');
        // Check for missing data
        if (empty($type_name)) {
            $_SESSION['message'] = '<p>Please provide information for all form fields.</p>';
            include '../view/add-type.php';
            unset($_SESSION['message']);
            exit;
        }

        // Send the data to the model
        $classOutcome = addType($type_name, $classification_id);

        // Check and report the result
        if ($classOutcome === 1) {
            header("Location: /frankies/animals/");
            exit;
        } else {
            $_SESSION['message'] = '<p class="">Sorry, but the type adding failed. Please try again.</p>';
            include '../view/animal-man.php';
            unset($_SESSION['message']);
            exit;
        }

        break;
    default:

        $typeList = buildTypeList($types);

        include '../view/animal-man.php';
        break;
}
