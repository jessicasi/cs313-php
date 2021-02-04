<?php

//Build the navigation bar
function getNavList($species)
{
   $navList = '<ul>';
   $navList .= "<li><a href='../frankies' title='Frankie's Farm Home Page'>Home</a></li>";
   foreach ($species as $type) {
      $navList .= "<li><a href='../frankies/animals?action=species&speciesName="
         . urlencode($type['speciesName']) .
         "' title='View our $type[speciesName]'>$species[speciesName]</a></li>";
   }
   $navList .= '</ul>';
   return $navList;
}
