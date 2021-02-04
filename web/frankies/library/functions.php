<?php

//Build the navigation bar
function getNavList($classifications)
{
   $navList = '<ul>';
   $navList .= "<li><a href='../frankies' title='Frankie's Farm Home Page'>Home</a></li>";
   foreach ($classifications as $classification) {
      $navList .= "<li><a href='../frankies/animals?action=species&speciesType="
         . urlencode($classification['classification_name']) .
         "' title='View our $classification[classification_name]'>$classification[classification_name]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}
