<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/route.php';

include 'includes/html-body-start.php';

$offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;
$tips = getUpcomingRoutes($offset, 100);

?>

<?php

include 'includes/html-body-end.php';
