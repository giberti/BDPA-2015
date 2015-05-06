<?php

/**
 * Uses the database connection to interact with the routes
 */

function getRouteById($routeid) {
    global $mysql;
    $select = "SELECT * FROM routes WHERE RouteID = " . $routeid;
    $result = $mysql->query($select);
    if ($result) {
        return $result->fetch_assoc();
    }
    return false;
}

function getRoutesByUserID($userid) {
    global $mysql;
    $select = "SELECT * FROM routes WHERE UserID = " . $userid;
    $result = $mysql->query($select);
    if ($result) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    return false;
}

function getUpcomingRoutes($rowoffset = 0, $pagesize = 9999) {
    global $mysql;
    $select = "SELECT * FROM routes ORDER BY DateLastRidden ASC LIMIT {$rowoffset},{$pagesize}";
    $result = $mysql->query($select);
    if($result) {
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    return false;
}

// RouteName, Distance, Difficulty, Type, MapImage


function addRoute($userid, $name, $description, $distance, $difficulty, $type, $mapimageurl, $dateridden = '0') {
    global $mysql;

    $columns = '';
    $values = '';
    $data = array(
        'UserID' => (int) $userid,
        'Name' => addslashes($name),
        'Description' => addslashes($description),
        'Distance' => addslashes($distance),
        'Difficulty' => addslashes($difficulty),
        'Type' => addslashes($type),
        'MapImageURL' => addslashes($mapimageurl),
        'DateRidden' => '0000-00-00 00:00:00',
        'DateAdded' => date('Y-m-d H:i:s'),
    );
    foreach ($data as $column => $value) {
        if (strlen($columns) > 0) {
            $columns .= ', ';
            $values .= ', ';
        }
        $columns .= $column;
        $values .= "'" . $value . "'";
    }

    $insert = "INSERT INTO routes ({$columns}) VALUES ($values)";
    $result = $mysql->query($insert);
    if ($result) {
        $tipid = mysqli_insert_id($mysql);
        return getRouteById($tipid);
    }
    return false;
}

function updateRoute($routeid, $userid, $name, $description, $distance, $difficulty, $type, $mapimageurl, $dateridden = '0000-00-00 00:00:00') {
    global $mysql;
    // Don't update a non existant route
    if (false === getRouteById($routeid)) {
        return false;
    }

    $data = array(
        'UserID' => (int) $userid,
        'Name' => addslashes($name),
        'Description' => addslashes($description),
        'Distance' => addslashes($distance),
        'Difficulty' => addslashes($difficulty),
        'Type' => addslashes($type),
        'MapImageURL' => addslashes($mapimageurl),
        'DateRidden' => date('Y-m-d H:i:s', strtotime($dateridden)),
    );
    $updates = '';
    foreach ($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= $column . " = '" . $value . "'";
    }
    $update = "UPDATE routes SET {$updates} WHERE TipID = " . $routeid;
    $result = $mysql->query($update);
    if ($result) {
        return getRouteById($routeid);
    }
    return false;
}

function deleteRoute($routeid) {
    global $mysql;
    $delete = "DELETE FROM routes WHERE RouteID = " . $routeid;
    $result = $mysql->query($delete);
    if ($result) {
        return true;
    }
    return false;
}