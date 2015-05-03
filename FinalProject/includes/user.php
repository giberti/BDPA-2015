<?php

/**
 * Uses the database connection to interact with the user
 */

// get user record by email and password
function getUserByLogin($emailaddress, $password) {
    global $mysql;
    $passwordHash = sha1($password);
    $select = "SELECT * FROM users WHERE EmailAddress = '" . addslashes($emailaddress) . "' AND PasswordHash = '" . addslashes($passwordHash) . "'";
    $rows = $mysql->query($select);
    if ($rows->num_rows == 1) {
        return $rows->fetch_assoc();
    }
    return false;
}

// get user recod by id
function getUserById($userId) {
    global $mysql;
    $select = "SELECT * FROM users WHERE UserID = " . $userId;
    $rows = $mysql->query($select);
    if ($rows->num_rows == 1) {
        return $rows->fetch_assoc();
    }
    return false;
}

// get user record by email address - also can be used to see if user exists
function getUserByEmail($emailaddress) {
    global $mysql;
    $select = "SELECT * FROM users WHERE EmailAddress = '" . addslashes($emailaddress) . "'";
    $rows = $mysql->query($select);
    if ($rows->num_rows == 1) {
        return $rows->fetch_assoc();
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
        'EmailAddress' => addslashes($emailaddress),
        'PasswordHash' => addslashes(sha1($password)),
        'FirstName' => addslashes($firstname),
        'LastName' => addslashes($lastname),
        'Age' => (int) $age,
        'Address' => addslashes($address),
        'City' => addslashes($city),
        'State' => addslashes($state),
        'ZipCode' => addslashes($zipcode),
        'PhoneNumber' => addslashes($phonenumber),
        'PhotoUrl' => addslashes($photourl),
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
    $result = $mysql->query($insert);
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
        'EmailAddress' => addslashes($emailaddress),
        'PasswordHash' => addslashes(sha1($password)),
        'FirstName' => addslashes($firstname),
        'LastName' => addslashes($lastname),
        'Age' => (int) $age,
        'Address' => addslashes($address),
        'City' => addslashes($city),
        'State' => addslashes($state),
        'ZipCode' => addslashes($zipcode),
        'PhoneNumber' => addslashes($phonenumber),
        'PhotoUrl' => addslashes($photourl)
    );
    $updates = '';
    foreach ($data as $column => $value) {
        if (strlen($updates) > 0) {
            $updates .= ', ';
        }
        $updates .= $column . " = '" . $value . "'";
    }
    $update = "UPDATE users SET {$updates} WHERE UserID = " . $userid;
    $result = $mysql->query($update);
    if ($result) {
        return getUserById($userid);
    }
    return false;
}

// delete a user from the db
function deleteUser($userid) {
    global $mysql;
    $delete = "DELETE FROM users WHERE UserID = " . $userid;
    $result = $mysql->query($delete);
    if ($result) {
        return true;
    }
    return false;
}