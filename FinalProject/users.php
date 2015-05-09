<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/user.php';

    $pageSize = 15;
    $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

    include 'includes/html-body-start.php';

    $users = getAllUsers('LastName', $offset, $pageSize + 1);

    echo '<div class="container">';
    echo '<h1>Our Members</h1>';
    echo '<ul>';
    foreach ($users as $idx => $user) {
        echo '<li><a href="user.php?UserID=' . $user['UserID'] . '">';
        if (loggedInUser()) {
            echo htmlentities($user['FirstName']) . ' ' . htmlentities($user['LastName']);
        } else {
            echo htmlentities($user['FirstName']) . ' ' . htmlentities(substr($user['LastName'], 0, 1)) . '.';
        }
        echo '</a></li>';
    }
    echo '</ul>';
    echo '</div>';

    include 'includes/html-body-end.php';
