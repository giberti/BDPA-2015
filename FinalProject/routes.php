<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/route.php';

include 'includes/html-body-start.php';

$pageSize = 10;
$offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

// Are we working on a route?
$editRoute = false;
if (loggedInUser() && isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'edit':
            $editRoute = getRouteById($_GET['RouteID']);
            break;
        case 'save':
            if (!$_POST['RouteID']) {
                // new route
                addRoute(getUserID(), $_POST['Name'], $_POST['Description'], $_POST['Distance'], $_POST['Difficulty'], $_POST['Type'], $_POST['MapImageUrl']);
            } else {
                // editing an existing route
                updateRoute($_POST['RouteID'], getUserID(), $_POST['Name'], $_POST['Description'], $_POST['Distance'], $_POST['Difficulty'], $_POST['Type'], $_POST['MapImageUrl']);
            }
            break;
        case 'delete':
            if (isset($_GET['RouteID']) && $_GET['RouteID'] > 0) {
                deleteRoute($_GET['RouteID']);
            }
            break;
    }
}

$routes = getUpcomingRoutes($offset, 100);

// If this user is logged in, show the add/edit route form
if (loggedInUser()) {
    $routeFields = array(
        'RouteID' => '',
        'UserID' => '',
        'Name' => 'Route Name',
        'Description' => 'Description of Route',
        'Distance' => 'Distance (in miles)',
        'Difficulty' => 'Difficulty',
        'Type' => 'Type',
        'MapImageURL' => 'Map Image URL',
        'DateRidden' => '',
        'DateAdded' => ''
    );
    echo '<div class="container">';
    echo '<form action="' . getFilename() . '?action=save" method="post">';
    if ($editRoute) {
        echo '<h2>Editing this route</h2>';
    } else {
        echo '<h2>Add a new route!</h2>';
    }

    foreach ($routeFields as $fieldname => $label) {
        $value = '';
        if ($editRoute) {
            $value = htmlentities($editRoute[$fieldname]);
        }
        if ($label == '') {
            echo '<input type="hidden" name="' . $fieldname . '" value="' . $value . '" />';
        } else if ($fieldname == 'Type') {
            // @todo select box
            echo "<div class=\"form-group\">";
            echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
            echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
            echo "</div>";
        } else if ($fieldname == 'Description') {
            // @todo textarea
            echo "<div class=\"form-group\">";
            echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
            echo "<textarea class=\"form-control\" name=\"{$fieldname}\" id=\"input{$fieldname}\" placeholder=\"$label\" rows=\"3\" required>{$value}</textarea>";
            echo "</div>";
        } else {
            echo "<div class=\"form-group\">";
            echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
            echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
            echo "</div>";
        }
    }
    echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>';
    echo '</form>';
    echo '</div>';
}


include 'includes/html-body-end.php';
