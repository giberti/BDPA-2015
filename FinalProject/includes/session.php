<?php

session_start();

// Gets the logged in user from session
function loggedInUser() {
    return isset($_SESSION['user']) && $_SESSION['user'];
}

// Logs in the user
function loginUser($user) {
    $_SESSION['user'] = $user;
}

// Logs out the user
function logoutUser() {
    unset($_SESSION['user']);
}