<?php

//Main Frankie's Farms Model

function getSpecies(){
    //Create a connection object from the phpmotors connection function
    $db = frankiesFarmConnect();
    //The SQL statement to be used with the database
    $sql = 'SELECT animaltype, id FROM public.species ORDER BY animaltype ASC';
    //The next line creates the prepeared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next line runs the prepared statement
    $stmt->execute();
    //The next line gets the date from the database and stores it as an array in the $classifications variable
    $species = $stmt->fetchAll();
    //The next line closes the interation with the database
    $stmt->closeCursor();
    //The next line sends the array of data back to where the function ws called (this should be the controller)
    return $species;

}

//added: , classficationID in select statement

