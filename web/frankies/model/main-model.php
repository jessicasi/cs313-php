<?php

//Main Frankie's Farms Model

function getClassifications(){
    //Create a connection object from the phpmotors connection function
    $db = frankiesFarmConnect();
    //The SQL statement to be used with the database
    $sql = 'SELECT classification_type, classification_id FROM classification ORDER BY classification_type ASC';
    //The next line creates the prepeared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next line runs the prepared statement
    $stmt->execute();
    //The next line gets the date from the database and stores it as an array in the $classifications variable
    $classifications = $stmt->fetchAll();
    //The next line closes the interation with the database
    $stmt->closeCursor();
    //The next line sends the array of data back to where the function ws called (this should be the controller)

    return $classifications;

    

}


