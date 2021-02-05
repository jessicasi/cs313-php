<?php

//Get list of animals by type
function getAnimalsByType($classification_type)
{
    $db = frankiesFarmConnect();
    $sql = "SELECT a.animal_id, a.animal_type, a.animal_subtype, a.animal_name, a.classification_id
        FROM animals AS a
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