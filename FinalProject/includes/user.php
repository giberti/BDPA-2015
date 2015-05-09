<?php

/**
 * Uses the database connection to interact with the user
 */

// grab all current users
function getAllUsers($sortColumns = 'LastName', $rowoffset = 0, $pagesize = 9999) {
    global $mysql;
    $select = "SELECT * FROM users ORDER BY {$sortColumns} LIMIT {$rowoffset},{$pagesize}";
    $result = mysql_query($select, $mysql);
    if ($result) {
        $users = array();
        while (($row = mysql_fetch_assoc($result))) {
            $users[] = $row;
        }
        return $users;
    }
    return false;
}

// get user record by email and password
function getUserByLogin($emailaddress, $password) {
    global $mysql;
    $passwordHash = sha1($password);
    $select = "SELECT * FROM users WHERE EmailAddress = '" . mysql_real_escape_string($emailaddress, $mysql) . "' AND PasswordHash = '" . mysql_real_escape_string($passwordHash, $mysql) . "'";
    $result = mysql_query($select, $mysql);
    if (mysql_num_rows($result) == 1) {
        return mysql_fetch_assoc($result);
    }
    return false;
}

// get user recod by id
function getUserById($userId) {
    global $mysql;
    $select = "SELECT * FROM users WHERE UserID = " . $userId;
    $result = mysql_query($select, $mysql);
    if (mysql_num_rows($result) == 1) {
        return mysql_fetch_assoc($result);
    }
    return false;
}

// get user record by email address - also can be used to see if user exists
function getUserByEmail($emailaddress) {
    global $mysql;
    $select = "SELECT * FROM users WHERE EmailAddress = '" . mysql_real_escape_string($emailaddress, $mysql) . "'";
    $result = mysql_query($select, $mysql);
    if (mysql_num_rows($result) == 1) {
        return mysql_fetch_assoc($result);
    }
    return false;
}

// create a new user in the db
function addUser($emailaddress, $password, $firstname, $lastname, $age, $address, $city, $state, $zipcode, $phonenumber, $photourl){
    // We can't add a user with the same email address
    if (false !== getUserByEmail($emailaddress)) {
        return false;
    }

    global $mysql;
    $columns = '';
    $values = '';
    $data = array(
        'EmailAddress' => mysql_real_escape_string($emailaddress, $mysql),
        'PasswordHash' => mysql_real_escape_string(sha1($password), $mysql),
        'FirstName' => mysql_real_escape_string($firstname, $mysql),
        'LastName' => mysql_real_escape_string($lastname, $mysql),
        'Age' => (int) $age,
        'Address' => mysql_real_escape_string($address, $mysql),
        'City' => mysql_real_escape_string($city, $mysql),
        'State' => mysql_real_escape_string($state, $mysql),
        'ZipCode' => mysql_real_escape_string($zipcode, $mysql),
        'PhoneNumber' => mysql_real_escape_string($phonenumber, $mysql),
        'PhotoUrl' => mysql_real_escape_string($photourl, $mysql),
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
    $insert = "INSERT INTO users ({$columns}) VALUES ({$values})";
    $result = mysql_query($insert, $mysql);
    if ($result) {
        return getUserByLogin($emailaddress, $password);
    }
    return false;
}

// Make changes to the user
function updateUser($userid, $emailaddress, $password, $firstname, $lastname, $age, $address, $city, $state, $zipcode, $phonenumber, $photourl) {
    // Don't update non-existent users
    if (false === getUserById($userid)) {
        return false;
    }

    global $mysql;
    $data = array(
        'EmailAddress' => mysql_real_escape_string($emailaddress, $mysql),
        'PasswordHash' => mysql_real_escape_string(sha1($password), $mysql),
        'FirstName' => mysql_real_escape_string($firstname, $mysql),
        'LastName' => mysql_real_escape_string($lastname, $mysql),
        'Age' => (int) $age,
        'Address' => mysql_real_escape_string($address, $mysql),
        'City' => mysql_real_escape_string($city, $mysql),
        'State' => mysql_real_escape_string($state, $mysql),
        'ZipCode' => mysql_real_escape_string($zipcode, $mysql),
        'PhoneNumber' => mysql_real_escape_string($phonenumber, $mysql),
        'PhotoUrl' => mysql_real_escape_string($photourl, $mysql)
    );
    $updates = '';
    foreach ($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= $column . " = '" . $value . "'";
    }
    $update = "UPDATE users SET {$updates} WHERE UserID = " . $userid;
    $result = mysql_query($update, $mysql);
    if ($result) {
        return getUserById($userid);
    }
    return false;
}

// delete a user from the db
function deleteUser($userid) {
    global $mysql;
    $delete = "DELETE FROM users WHERE UserID = " . $userid;
    $result = mysql_query($delete, $mysql);
    if ($result) {
        deleteAllBicyclesForUserId($userid);
        return true;
    }
    return false;
}