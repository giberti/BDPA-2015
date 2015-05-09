<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/user.php';
require 'includes/bicycle.php';

$userid = $_GET['UserID'] ? $_GET['UserID'] : 0;
$user = getUserById($userid);
if (!$user) {
    header('Location: users.php');
}

$bicycles = getBicyclesForUserID($userid);

include 'includes/html-body-start.php';

echo '<div class="container">';
if (loggedInUser()) {
    echo '<h1>' . htmlentities($user['FirstName']) . ' ' . htmlentities($user['LastName']) . ' (' . $user['Age'] . ')</h1>';
    echo '<p>' . htmlentities($user['EmailAddress']) . '</p>';
    echo '<p>' . htmlentities($user['Address']) . '<br />';
    echo htmlentities($user['City']) . ', ' . htmlentities($user['State']) . ' ' . htmlentities($user['ZipCode']);
    echo '</p>';
    echo '<p>' . htmlentities($user['PhoneNumber']) . '</p>';
} else {
    echo '<h1>' . htmlentities($user['FirstName']) . ' ' . htmlentities(substr($user['LastName'], 0, 1)) . '</h1>';
    echo '<p>' . htmlentities($user['City']) . ', ' . htmlentities($user['State']) . ' ' . htmlentities($user['ZipCode']) . '</p>';
}
echo '</div>';

$columns = array(
    'Type' => 'Type',
    'Speeds' => 'Speeds',
    'TireSizeInches' => 'Tire Size (inches)'
);

echo '<div class="container">';
foreach ($bicycles as $bike) {
    echo '<h4>' . htmlentities($bike['Manufacturer']) . '</h4>';
    echo '<table class="table">';
    foreach ($columns as $column => $label) {
        echo '<tr>';
        echo '<td>' . $label . '</td>';
        echo '<td>' . htmlentities($bike[$column]) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
echo '</div>';

include 'includes/html-body-end.php';
