<?php
function  getTypes(){
    //Create a connection object from the phpmotors connection function
    $db = frankiesFarmConnect();
    //The SQL statement to be used with the database
    $sql = 'SELECT t.type_id, t.type_name, t.classification_id
         FROM type AS t  ORDER BY type_name ASC';
    //The next line creates the prepeared statement using the phpmotors connection
    $stmt = $db->prepare($sql);
    //The next line runs the prepared statement
    $stmt->execute();
    //The next line gets the date from the database and stores it as an array in the $classifications variable
    $types = $stmt->fetchAll();
    //The next line closes the interation with the database
    $stmt->closeCursor();
    //The next line sends the array of data back to where the function ws called (this should be the controller)


    return $types;

}

//Get list of animals by type
function getAnimalsByType($classification_type)
{
    $db = frankiesFarmConnect();
    $sql = "SELECT a.animal_id, a.animal_type, a.animal_subtype, a.animal_name, a.classification_id, a.type_id, c.classification_type, c.classification_id, i.img_name, i.img_id, i.img_path, i.img_date, t.type_id, t.type_name, t.classification_id
        FROM animals AS a
        INNER JOIN
        images AS i
        ON a.animal_id = i.animal_id
        INNER JOIN
        type AS t
        ON a.type_id = t.type_id
        INNER JOIN
        classification AS c
        ON a.classification_id = c.classification_id
        WHERE c.classification_type = :classification_type";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classification_type', $classification_type, PDO::PARAM_STR);
    $stmt->execute();
    $animals = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $animals;
}

function getAnimalDetails($animal_id)
{
    $db = frankiesFarmConnect();

    $sql = "SELECT a.animal_id, a.animal_type, a.animal_subtype, a.animal_name, a.animal_age, a.animal_notes, i.img_id, i.img_name, i.img_path, i.img_date, i.animal_id, i.classification_id
        FROM animals AS a
        INNER JOIN
        images AS i
        ON a.animal_id = i.animal_id 
        WHERE i.animal_id = :animal_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':animal_id', $animal_id, PDO::PARAM_INT);
    $stmt->execute();
    $animalInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();

    return $animalInfo;
}
