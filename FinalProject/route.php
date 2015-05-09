<?php

$routeid = isset($_GET['RouteID']) ? $_GET['RouteID'] : false;
if (!$routeid) {
    header('Location: routes.php');
}

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/route.php';

include 'includes/html-body-start.php';

$route = getRouteById($routeid);
if (!$route) {
    echo '<div class="container">';
    echo '<h1>Unable to locate that route</h1>';
    echo '<a href="routes.php">View our other routes</a>';
    echo '</div>';
} else {
    // display the route as awesomely as possible
    if ($route['MapImageURL']) {
?>
    <style>
        .backgroundUrl {
            background-image: url(<?php echo $route['MapImageURL'];?>);
            background-size: cover;
        }
    </style>
    <div class="jumbotron backgroundUrl">
        <div class="container">
            <h1><?php echo htmlentities($route['Name']);?></h1>
        </div>
    </div>
<?php
    }
?>
    <div class="container">
        <?php
        if (!$route['MapImageURL']) {
            echo '<h1>' . htmlentities($route['Name']) . '</h1>';
        }
        if (loggedInUser()) {
            echo '<a href="routes.php?action=edit&RouteID=' . $route['RouteID'] . '">Edit route</a>';
        }
        ?>

        <p><?php echo htmlentities($route['Description']);?></p>

        <table class="table">
            <tr>
                <td>Difficulty</td>
                <td><?php echo htmlentities($route['Difficulty']) ?></td>
            </tr>
            <tr>
                <td>Miles</td>
                <td><?php echo htmlentities($route['Distance']) ?></td>
            </tr>
            <tr>
                <td>Type</td>
                <td><?php echo htmlentities($route['Type']) ?></td>
            </tr>
        </table>

        <a href="<?php echo $route['MapImageURL'];?>" title="Click to download"><img src="<?php echo $route['MapImageURL'];?>" width="100%" /></a>
    </div>
<?php
}


include 'includes/html-body-end.php';
