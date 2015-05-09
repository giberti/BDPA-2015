<?php

/**
 * Uses the database connection to interact with bicycles
 */

// get all the bicycles belonging to a specific user
function getBicyclesForUserID($userid) {
    global $mysql;
    $select = "SELECT * FROM bicycles WHERE UserID = " . $userid;
    $result = mysql_query($select, $mysql);
    if ($result) {
        $bicycles = array();
        while (($row = mysql_fetch_assoc($result))) {
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
    $result = mysql_query($select, $mysql);
    if ($result) {
        return mysql_fetch_assoc($result);
    }
    return false;
}

// add a new bicycle
function addBicycle($userid, $manufacturer, $type, $speeds, $tiresizeinches, $imageurl) {
    global $mysql;
    $data = array(
        'UserID' => (int) $userid,
        'Manufacturer' => mysql_real_escape_string($manufacturer, $mysql),
        'Type' => mysql_real_escape_string($type, $mysql),
        'Speeds' => mysql_real_escape_string($speeds, $mysql),
        'TireSizeInches' => mysql_real_escape_string($tiresizeinches, $mysql),
        'ImageUrl' => mysql_real_escape_string($imageurl, $mysql)
    );
    $columns = '';
    $values = '';
    foreach($data as $column => $value) {
        if (strlen($columns) > 0) {
            $columns .= ', ';
            $values .= ', ';
        }
        $columns .= $column;
        $values .= "'" . $value . "'";
    }

    $insert = "INSERT INTO bicycles ({$columns}) VALUES ({$values})";
    $result = mysql_query($insert, $mysql);
    if ($result) {
        return mysql_insert_id($mysql);
    }
    return false;
}

// update the information for a specific bicycle
function updateBicycle($bicycleid, $userid, $manufacturer, $type, $speeds, $tiresizeinches, $imageurl) {
    global $mysql;
    $data = array(
        'UserID' => (int) $userid,
        'Manufacturer' => mysql_real_escape_string($manufacturer, $mysql),
        'Type' => mysql_real_escape_string($type, $mysql),
        'Speeds' => mysql_real_escape_string($speeds, $mysql),
        'TireSizeInches' => mysql_real_escape_string($tiresizeinches, $mysql),
        'ImageUrl' => mysql_real_escape_string($imageurl, $mysql)
    );
    $updates = '';
    foreach($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= "{$column} = '{$value}'";
    }
    $update = "UPDATE bicycles SET {$updates} WHERE bicycleid = {$bicycleid}";
    $result = mysql_query($update, $mysql);
    if ($result) {
        return getBicycleByID($bicycleid);
    }
    return false;
}

// remove a bicycle from the database
function deleteAllBicyclesForUserId($userid) {
    global $mysql;
    $delete = "DELETE FROM bicycles WHERE userid = " . $userid;
    $result = mysql_query($delete, $mysql);
    if ($result) {
        return true;
    }
    return false;
}