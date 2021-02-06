<?php

//Build the navigation bar
function getNavList($classifications)
{
   $navList = '<div class="collapse navbar-collapse" id="collapsibleNavbar">';
   $navList .= '<ul class="navbar-nav>';
   $navList .= "<li class='nav-item'><a  class='nav-link' href='/frankies' title='Frankie's Farm Home Page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li class='nav-item'><a class='nav-link' href='/frankies/animals?action=classification&classification_type="
         . urlencode($classification['classification_type']) .
         "' title='View our $classification[classification_type]'>$classification[classification_type]</a></li>";
   }
   $navList .= '</ul></div>';
   return $navList;
}


//build display of animals
function buildAnimalDisplay($animals){
   $adv = '<ul id="animal-display">';
   foreach ($animals as $animal){
      $adv.= "<li><a href='../animals?action=information&animal_id=". urlencode($animal['animal_id']) . "'>";
      $adv .= "<h2>$animal[animal_type] - $animal[animal_subtype]</h2>";
      $adv .= "<span><img src='$animal[img_path]' alt='Image of $animal[animal_name]'></span>";
      $adv .= "<p>$animal[animal_name]</p>";
      $adv .= "</a></li>";
   }
   return $adv;
}

function buildDetailDisplay($animal){
   $dd = '<div id="animalDisplay">';
   $dd .= "<h1>$animal[animal_type] $animal[animal_subtype]</h1>"; 
   $dd .= "<h2>$animal[animal_name]</h2>";
   $dd .= "<span><img src='$animal[img_path]' alt='Image of $animal[animal_name]'></span>";
   $dd .= "<section><h3>Description</h3></section>";
   $dd .= "<p>$animal[animal_notes]</p>";

   return $dd;
}

function buildAnimalList($types) {
   $typeList = '<select name="type_id" id="type_id">';
   $typeList .= "<option>Filter By</option>";
   foreach ($types as $type){
         $typeList .= "<option value='$type[type_id]'>$type[type_name]</option>";
   } 
   $typeList .= '</select>';

   return $typeList;

}
