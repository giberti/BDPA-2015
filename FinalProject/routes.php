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

// If this user is logged in, show the add/edit route form
if (loggedInUser()) {

    $displayStyle = 'none';

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

    if ($editRoute) {
        $displayStyle = 'block';
    }

    echo '<div class="container" id="addEditForm" style="display:' . $displayStyle. ';">';
    echo '<form action="' . getFilename() . '?action=save" method="post">';

    if ($editRoute) {
        $displayStyle = 'block';
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

$routes = getUpcomingRoutes($offset, $pageSize + 1);

echo '<div class="container">';
echo '<div class="row">';
echo '<div class="col-md-12">';
echo '<h1>Routes</h1>';
if (loggedInUser() && !$editRoute) {
    echo '<p>';
    echo '<a id="addNewLink" onclick="showAddEditForm();">Add new route</a>';
    echo '</p>';
}

foreach ($routes as $route) {
    echo '<div class="row">';
    if (loggedInUser()) {
        ?>
        <div class="col-xs-2">
            <div class="btn-group-xs">
                <a href="<?php echo getFilename(); ?>?action=edit&RouteID=<?php echo $route['RouteID']; ?>&offset=<?php echo $offset; ?>" class="btn btn-primary" aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="<?php echo getFilename(); ?>?action=delete&RouteID=<?php echo $route['RouteID']; ?>&offset=<?php echo $offset; ?>" class="btn btn-danger" aria-label="Left Align" onclick="return confirm('Are you sure you want to delete this route?');">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </div>
        </div>
    <?php
    }
    echo '<div class="col-xs-10">';

    echo '<h4>' . htmlentities($route['Name']) .  ' (' . htmlentities($route['Difficulty']) . ')</h4>';
    echo '<p>' . htmlentities($route['Type']) . ' ' . round($route['Distance'], 1) . ' miles</p>';
    if (strlen($route['Description']) < 100) {
        echo '<p>' . htmlentities($route['Description']) . '</p>';
    } else {
        echo '<p>' . htmlentities(substr($route['Description'], 0, 95)) . '...</p>';
    }
    echo '</div>';
    echo '</div>';
}

// Show pagination information
echo '<p>';
if ($offset > 0) {
    echo '<a href="' . getFilename() . '?offset=' . ($offset - $pageSize) . '"> &lt; Back</a>';
    echo ' ';
}
if (count($routes) > $pageSize) {
    echo '<a href="' . getFilename() . '?offset=' . ($offset + $pageSize) . '">Next &gt;</a>';
}
echo '</p>';

echo '</div>';
echo '</div>';
echo '</div>';

include 'includes/html-body-end.php';
