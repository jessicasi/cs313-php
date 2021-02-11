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
   $sql = 'SELECT r.review_text, r.review_date, r.type_id. a.type_id
   FROM reviews r, animals a
   WHERE review_id = :review_id
   AND a.type_id = a.typeId';
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