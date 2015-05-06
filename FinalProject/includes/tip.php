<?php

/**
 * Uses the database connection to interact with the tips
 */

function getTipById($tipid) {
    global $mysql;
    $select = "SELECT * FROM tips WHERE TipID = " . $tipid;
    $result = $mysql->query($select);
    if ($result) {
        return $result->fetch_assoc();
    }
    return false;
}

function getTipsByUser($userid) {
    global $mysql;
    $select = "SELECT * FROM tips WHERE UserID = " . $userid;
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

function getRecentTips($rowoffset = 0, $pagesize = 9999) {
    global $mysql;
    $select = "SELECT * FROM tips ORDER BY DateAdded DESC LIMIT {$rowoffset},{$pagesize}";
    $result = $mysql->query($select);
    if ($result) {
        $rows = array();
        while($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
    return false;
}

function addTip($userid, $type, $text) {
    global $mysql;

    $columns = '';
    $values = '';
    $data = array(
        'UserID' => (int) $userid,
        'Type' => addslashes($type),
        'Text' => addslashes($text),
        'DateAdded' => date('Y-m-d H:i:s')
    );
    foreach ($data as $column => $value) {
        if (strlen($columns) > 0) {
            $columns .= ', ';
            $values .= ', ';
        }
        $columns .= $column;
        $values .= "'" . $value . "'";
    }

    $insert = "INSERT INTO tips ({$columns}) VALUES ($values)";
    $result = $mysql->query($insert);
    if ($result) {
        $tipid = mysqli_insert_id($mysql);
        return getTipById($tipid);
    }
    return false;
}

function updateTip($tipid, $userid, $type, $text) {
    global $mysql;
    // Don't update a non existant tip
    if (false === getTipById($tipid)) {
        return false;
    }

    $data = array(
        'UserID' => (int) $userid,
        'Type' => addslashes($type),
        'Text' => addslashes($text)
    );
    $updates = '';
    foreach ($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= $column . " = '" . $value . "'";
    }
    $update = "UPDATE tips SET {$updates} WHERE TipID = " . $tipid;
    $result = $mysql->query($update);
    if ($result) {
        return getTipById($tipid);
    }
    return false;
}

function deleteTip($tipid) {
    global $mysql;
    $delete = "DELETE FROM tips WHERE TipID = " . $tipid;
    $result = $mysql->query($delete);
    if ($result) {
        return true;
    }
    return false;
}

