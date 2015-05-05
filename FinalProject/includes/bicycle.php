<?php

/**
 * Uses the database connection to interact with bicycles
 */

// get all the bicycles belonging to a specific user
function getBicyclesForUserID($userid) {
    global $mysql;
    $select = "SELECT * FROM bicycles WHERE UserID = " . $userid;
    $bikes = $mysql->query($select);
    if ($bikes) {
        $bicycles = array();
        while ($row = $bikes->fetch_assoc()) {
            $bicycles[] = $row;
        }
        return $bicycles;
    }
    return false;
}

// get a specific bicycle
function getBicycleByID($bicycleid) {
    global $mysql;
    $select = "SELECT * FROM bicycles WHERE BicycleID = " . $bicycleid;
    $result = $mysql->query($select);
    if ($result) {
        return $result->fetch_assoc();
    }
    return false;
}

// add a new bicycle
function addBicycle($userid, $manufacturer, $type, $speeds, $tiresizeinches, $imageurl) {
    global $mysql;
    $data = array(
        'UserID' => (int) $userid,
        'Manufacturer' => addslashes($manufacturer),
        'Type' => addslashes($type),
        'Speeds' => addslashes($speeds),
        'TireSizeInches' => addslashes($tiresizeinches),
        'ImageUrl' => addslashes($imageurl)
    );
    $columns = '';
    $values = '';
    foreach($data as $column => $value) {
        if (strlen($columns) > 0) {
            $columns .= ', ';
            $values .= ', ';
        }
        $columns .= $column;
        $values .= $values;
    }

    $insert = "INSERT INTO ({$columns}) VALUES ({$values})";
    $result = $mysql->query($insert);
    if ($result) {
        return mysql_insert_id($result);
    }
    return false;
}

// update the information for a specific bicycle
function updateBicycle($bicycleid, $userid, $manufacturer, $type, $speeds, $tiresizeinches, $imageurl) {
    global $mysql;
    $data = array(
        'UserID' => (int) $userid,
        'Manufacturer' => addslashes($manufacturer),
        'Type' => addslashes($type),
        'Speeds' => addslashes($speeds),
        'TireSizeInches' => addslashes($tiresizeinches),
        'ImageUrl' => addslashes($imageurl)
    );
    $updates = '';
    foreach($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= "{$column} = '{$value}'";
    }
    $update = "UPDATE bicycles SET {$updates} WHERE bicycleid = {$bicycleid}";
    $result = $mysql->query($update);
    if ($result) {
        return getBicycleByID($bicycleid);
    }
    return false;
}

// remove a bicycle from the database
function deleteAllBicyclesForUserId($userid) {
    global $mysql;
    $delete = "DELETE FROM bicycles WHERE userid = " . $userid;
    $result = $mysql->query($delete);
    if ($result) {
        return true;
    }
    return false;
}