<?php
// Check for an existing image
function checkExistingImage($img_name)
{
    $db = frankiesFarmConnect();
    $sql = "SELECT img_name FROM images WHERE img_name = :name";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':name', $img_name, PDO::PARAM_STR);
    $stmt->execute();
    $imageMatch = $stmt->fetch();
    $stmt->closeCursor();
    return $imageMatch;
}

// Add image information to the database table
function storeImages($img_path, $animal_id,$img_name)
{
    $db = frankiesFarmConnect();
    
    $sql = 'INSERT INTO images (animal_id, img_path, img_name) VALUES (:animal_id, :img_path, :img_name)';
    $stmt = $db->prepare($sql);
    // Store the full size image information
    $stmt->bindValue(':animal_id', $animal_id, PDO::PARAM_INT);
    $stmt->bindValue(':img_path', $img_path, PDO::PARAM_STR);
    $stmt->bindValue(':img_name', $img_name, PDO::PARAM_STR);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}

// Get Image Information from images table
function getImages()
{
    $db = frankiesFarmConnect();
    $sql = 'SELECT img_id, img_path, img_name, img_date, animal_id, animal_type, animal_subtype FROM images JOIN animals ON images.animal_id = animals.animal_id';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $imageArray = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $imageArray;
}

// Delete image information from the images table
function deleteImage($img_id)
{
    $db = frankiesFarmConnect();
    $sql = 'DELETE FROM images WHERE img_id = :img_id';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':img_id', $img_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->rowCount();
    $stmt->closeCursor();
    return $result;
}

?>