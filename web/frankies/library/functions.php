<?php

//Build the navigation bar
function getNavList($classifications)
{
   $navList = '<div class="collapse navbar-collapse" id="navbarSupportedContent">';
   $navList .= '<ul class="navbar-nav me-auto mb-2 mb-lg-0">';
   $navList .= "<li class='nav-item'><a  class='nav-link' href='/frankies' title='Frankie\'s Farm Home Page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li class='nav-item'><a class='nav-link' href='/frankies/animals?action=classification&classification_type="
         . urlencode($classification['classification_type']) .
         "' title='View our $classification[classification_type]'>$classification[classification_type]</a></li>";
   }
   if (isset($_SESSION['loggedin'])) {

      $navList .= ' <a href="/frankies/accounts/index.php?action=Logout" class="navLink" title="Logout">Log Out</a>';
  
  } else {
   $navList .= ' <a href="/frankies/accounts/index.php?action=deliverLoginView" class="navLink" title="Login or Register">Log In</a>';
  }
   $navList .= '</ul></div>';
   return $navList;
}


//build display of animals
function buildAnimalDisplay($animals){
   $adv = '<ul id="animal-display">';
   foreach ($animals as $animal){
      $adv.= "<li><a class='detailLink' href='../animals?action=information&animal_id=". urlencode($animal['animal_id']) . "'>";
      $adv .= "<h2>$animal[animal_type]</h2> <h3>$animal[animal_subtype]</h3>";
      $adv .= "<span><img class='displayImg' src='$animal[img_path]' alt='Image of $animal[animal_name]'></span></a>";
      $adv .= "<p class='animalName'>$animal[animal_name]</p>";
      $adv .= "</li>";
   }

      $adv .= "</ul>";
   return $adv;
}

function buildDetailDisplay($animal){
   $dd = '<div id="detailDisplay">';
   $dd .= "<h1>$animal[animal_subtype] - $animal[animal_type]</h1>"; 
   $dd .= "<h2 class='animalName'>$animal[animal_name]</h2>";
   $dd .= "<span><img src='$animal[img_path]' alt='Image of $animal[animal_name]' img class='displayImg'></span>";
   $dd .= "<section><h3>Description</h3>";
   $dd .= "<p>$animal[animal_notes]</p></section></div>";

   return $dd;
}

function buildAnimalList($types) {
   $typeList = '<select name="type_id" id="type_id">';
   foreach ($types as $type){
         $typeList .= "<option value='$type[type_id]'>$type[type_name]s</option>";
   } 
   $typeList .= '</select>';

   return $typeList;

}

function checkEmail($people_email)
{
   $valEmail = filter_var($people_email, FILTER_VALIDATE_EMAIL);
   return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($people_password)
{
   $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]])(?=.*[A-Z])(?=.*[a-z])([^\s]){8,}$/';
   return preg_match($pattern, $people_password);
}

function getScreenName($people_fname, $people_lname){
   $screenName = substr($people_fname, 0,1);
   $screenName .=$people_lname;
   return $screenName;
}

function buildReviewDisplay($reviews){
   $rv = '<div id="review-display">';
   foreach ($reviews as $review){
      $rv .= "<p class='reviewName'>";
      $rv .= getScreenName($review['people_fname'], $review['people_lname']);
      $rv .= " wrote on ";
      $rv .= date("j F, Y", strtotime($review['review_date']));
      $rv .="</p><p class='reviewInfo'>$review[review_text]";
   }
   $rv .=' </div>';
   return $rv;
}

function getReviewInfo($review_id){
   $db = frankiesFarmConnect();
   $sql = 'SELECT r.review_text, r.review_date, r.type_id, a.type_id
   FROM reviews r, animals a
   WHERE review_id = :review_id
   AND a.type_id = a.type_id';
   $stmt = $db->prepare($sql);
   $stmt->bindValue(':review_id', $review_id, PDO::PARAM_INT);
   $stmt->execute();
   $reviewInfo = $stmt->fetch(PDO::FETCH_ASSOC);
   $stmt->closeCursor();
   return $reviewInfo;
}

//Get Review Date
function getReviewDate($review_date){
   $review_date = date("j F, Y", strtotime(($review_date)));
   return $review_date;
  }
  

  function buildPersonalReviewDisplay($personalReviews){
   $prv = '<ul>';
   foreach ($personalReviews as $pr){

      $prv .= "<li> $pr[type_namw]";
      $prv .= "(Reviewed on ";
      $prv .= date("j F, Y", strtotime($pr['review_date']));
      $prv .= ")";
      $prv .= "<a href='/frankies/reviews/index.php?action=deliverEditView&review_id=$pr[review_id]' title=' Deliver Edit Review' > Edit </a> | <a href='/frankies/reviews/index.php?action=deliverDeleteView&review_id=$pr[review_id]' title='Deliver Delete View'> Delete </a></li>";
   }
   $prv .='</ul>';
 
   return $prv;
  }


  // Build the classifications select list 
function buildTypeList($types)
{
   $typeList = '<select id="typeList">';
   $typeList .= "<option>Choose a Classification</option>";
   foreach ($types as $type) {
      $typeList .= "<option value='$type[type_id]'>$type[type_name]</option>";
   }
   $typeList .= '</select>';
   return $typeList;
}

function buildClassSelect($classifications){
   $classificationList = '<select id="typeList">';
   $classificationList .= "<option>Choose a Classification</option>";
   foreach ($classifications as $classification) {
      $classificationList .= "<option value='$classification[classification_id]'>$classification[classification_type]</option>";
   }
   $classificationList .= '</select>';
   return $classificationList;
}

function uploadFile($name){
   // Gets the paths, full and local directory
   global $image_dir, $image_dir_path;
   if (isset($_FILES[$name])) {
      // Gets the actual file name
      $filename = $_FILES[$name]['name'];
      if (empty($filename)) {
         return;
      }
      // Get the file from the temp folder on the server
      $source = $_FILES[$name]['tmp_name'];
      // Sets the new path - images folder in this directory
      $target = $image_dir_path . '/' . $filename;
      // Moves the file to the target folder
      move_uploaded_file($source, $target);
      // Send file for further processing
      processImage($image_dir_path, $filename);
      // Sets the path for the image for Database storage
      $filepath = $image_dir . '/' . $filename;
      // Returns the path where the file is stored
      return $filepath;
   }
   
   }

   // Processes images by getting paths and 
// creating smaller versions of the image
function processImage($dir, $filename)
{
   // Set up the variables
   $dir = $dir . '/';

   // Set up the image path
   $image_path = $dir . $filename;

   // Resize original to a maximum of 500 pixels square
   resizeImage($image_path, $image_path, 500, 500);
}

// Checks and Resizes image
function resizeImage($old_image_path, $new_image_path, $max_width, $max_height) {
     
   // Get image type
   $image_info = getimagesize($old_image_path);
   $image_type = $image_info[2];
  
   // Set up the function names
   switch ($image_type) {
   case IMAGETYPE_JPEG:
    $image_from_file = 'imagecreatefromjpeg';
    $image_to_file = 'imagejpeg';
   break;
   case IMAGETYPE_GIF:
    $image_from_file = 'imagecreatefromgif';
    $image_to_file = 'imagegif';
   break;
   case IMAGETYPE_PNG:
    $image_from_file = 'imagecreatefrompng';
    $image_to_file = 'imagepng';
   break;
   default:
    return;
  } // ends the switch
  
   // Get the old image and its height and width
   $old_image = $image_from_file($old_image_path);
   $old_width = imagesx($old_image);
   $old_height = imagesy($old_image);
  
   // Calculate height and width ratios
   $width_ratio = $old_width / $max_width;
   $height_ratio = $old_height / $max_height;
  
   // If image is larger than specified ratio, create the new image
   if ($width_ratio > 1 || $height_ratio > 1) {
  
    // Calculate height and width for the new image
    $ratio = max($width_ratio, $height_ratio);
    $new_height = round($old_height / $ratio);
    $new_width = round($old_width / $ratio);
  
    // Create the new image
    $new_image = imagecreatetruecolor($new_width, $new_height);
  
    // Set transparency according to image type
    if ($image_type == IMAGETYPE_GIF) {
     $alpha = imagecolorallocatealpha($new_image, 0, 0, 0, 127);
     imagecolortransparent($new_image, $alpha);
    }
  
    if ($image_type == IMAGETYPE_PNG || $image_type == IMAGETYPE_GIF) {
     imagealphablending($new_image, false);
     imagesavealpha($new_image, true);
    }
  
    // Copy old image to new image - this resizes the image
    $new_x = 0;
    $new_y = 0;
    $old_x = 0;
    $old_y = 0;
    imagecopyresampled($new_image, $old_image, $new_x, $new_y, $old_x, $old_y, $new_width, $new_height, $old_width, $old_height);
  
    // Write the new image to a new file
    $image_to_file($new_image, $new_image_path);
    // Free any memory associated with the new image
    imagedestroy($new_image);
    } else {
    // Write the old image to a new file
    $image_to_file($old_image, $new_image_path);
    }
    // Free any memory associated with the old image
    imagedestroy($old_image);
  } // ends resize function


  