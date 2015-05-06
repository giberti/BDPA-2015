<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/user.php';
    require 'includes/route.php';
    require 'includes/tip.php';

    include 'includes/html-body-start.php';

    // Get the data that we'll want to display on the homepage
    $newTips = getRecentTips(0,5);
    $newRoutes = getUpcomingRoutes(0,5);

?>

<?php

    include 'includes/html-body-end.php';
