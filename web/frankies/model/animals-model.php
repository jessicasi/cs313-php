<?php

    //Get list of animals by type
    function getAnimalsByType($classification_type){
        $db = frankiesFarmConnect();
        $sql = "SELECT a.animal_id, a.animal_type, a.animal_subtype, a.animal_age, a.animal_notes, a.classification_id
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

        var_dump($animals);
        exit;
        return $animals;
    }







?>