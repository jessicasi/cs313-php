<?php

//Check for exisiting email addresses in the database
function checkExistingEmail($people_email) {
    $db =  frankiesFarmConnect();
    $sql = 'SELECT people_email FROM people WHERE people_email = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $people_email, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if(empty($matchEmail)){
        return 0;
    } else {
      return 1;
    
    }
}

function regClient($people_fname, $people_lname, $people_email, $people_password) {
    $db =  frankiesFarmConnect();
    $sql = 'INSERT INTO people (people_fname, people_lname, people_email, people_password)
    VALUES (:people_fname, :people_lname, :people_email, :people_password)';
    $stmt = $db ->prepare($sql);
    $stmt->bindValue(':people_fname', $people_fname, PDO::PARAM_STR);
    $stmt->bindValue(':people_lname', $people_lname, PDO::PARAM_STR);
    $stmt->bindValue(':people_email', $people_email, PDO::PARAM_STR);
    $stmt->bindValue(':people_password', $people_password, PDO::PARAM_STR);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();

    return $rowsChanged;
}


function getClient($people_email){
    $db = frankiesFarmConnect();
    $sql = 'SELECT people_id, people_fname, people_lname, people_email, people_level, people_password
    FROM people 
    WHERE people_email = :people_email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':people_email', $people_email, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }


   function updateClient($people_fname, $people_lname, $people_email, $people_id){
   
    $db = frankiesFarmConnect();
    $sql = 'UPDATE people SET people_fname = :people_fname, people_lname = :people_lname, people_email = :people_email WHERE people_id = :people_id';
    $stmt = $db ->prepare($sql);
    $stmt->bindValue(':people_fname', $people_fname, PDO::PARAM_STR);
    $stmt->bindValue(':people_lname', $people_lname, PDO::PARAM_STR);
    $stmt->bindValue(':people_email', $people_email, PDO::PARAM_STR);
    $stmt->bindValue(':people_id', $people_id, PDO::PARAM_INT);
    
    $stmt->execute();
   $rowsChanged = $stmt->rowCount();
   $stmt->closeCursor();

   return $rowsChanged;

   }

   function getNewClient($people_id) {
    $db = frankiesFarmConnect();
    $sql = 'SELECT * FROM people WHERE people_id = :people_id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':people_id', $people_id, PDO::PARAM_INT);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
   }

      //Update Password
      function updatePassword($people_password, $people_id){
          echo $people_password;
        $db = frankiesFarmConnect();
        $sql = 'UPDATE people SET people_password = :people_password WHERE people_id = :people_id';
    
        $stmt = $db->prepare($sql);
       $stmt->bindValue(':people_password', $people_password, PDO::PARAM_STR);
       $stmt->bindValue(':people_id', $people_id, PDO::PARAM_INT);
       $stmt->execute();
       $rowsChanged = $stmt->rowCount();
       $stmt->closeCursor();
    
       return $rowsChanged;
    
       }

?>