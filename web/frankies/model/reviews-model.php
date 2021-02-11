<?php

    function newReview($review_text, $type_id,$people_id){
        //Create a connection object using phpmotors connection function
    $db = frankiesFarmConnect();
    // The SQL statement
    $sql = 'INSERT INTO reviews (review_text, type_id, people_id)
     VALUES (:review_text, :type_id, :people_id)';
    // Create the prepared statement using the phpmotors connection
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':review_text', $review_text, PDO::PARAM_STR);
    $stmt->bindValue(':type_id', $type_id, PDO::PARAM_INT);
    $stmt->bindValue(':people_id', $people_id, PDO::PARAM_STR);

    //Insert the data
    $stmt->execute();

    //Ask how many rows changed

    $rowsChanged = $stmt->rowCount();
    //Close database connection
    $stmt->closeCursor();
    //Return indication of success or failure
    return $rowsChanged;

    }

    function getReviews($type_id){
        $db = frankiesFarmConnect();
        $stmt = $db->prepare('SELECT r.review_id, r.review_text, r.review_date, r.type_id, r.people_id, p.people_fname, p.people_lname FROM reviews r, people p WHERE type_id = :type_id AND p.people_id = r.people_id ORDER BY r.review_date DESC');
        $stmt->bindValue(':type_id', $type_id, PDO::PARAM_INT);
        $stmt->execute();
        $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $reviews;
    }


    function getPersonalReviews($people_id){
        $db = frankiesFarmConnect();
        $sql = 'SELECT r.review_id, r.review_text, r.review_date, r.people_id, r.type_id, p.people_id, t.type_id, t.type_name 
        FROM reviews AS r
        INNER JOIN 
        type AS t
        ON r.type_id = t.type_id
        INNER JOIN 
        people AS p
        ON r.people_id = p.people_id
        WHERE r.people_id = :people_id
        ORDER BY r.review_date DESC';
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':people_id', $people_id, PDO::PARAM_INT);
        $stmt->execute();
        $personalReviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $personalReviews;
    }

?>