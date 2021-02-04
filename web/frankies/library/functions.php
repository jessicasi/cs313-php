<?php

//Build the navigation bar
function getNavList($classifications)
{
   $navList = '<ul>';
   $navList .= "<li><a href='../frankies' title='Frankie's Farm Home Page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li><a href='../frankies/animals?action=classification&classification_type="
         . urlencode($classification['classification_type']) .
         "' title='View our $classification[classification_type]'>$classification[classification_type]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}
