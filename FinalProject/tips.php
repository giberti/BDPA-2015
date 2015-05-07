<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/tip.php';

include 'includes/html-body-start.php';

$offset = (int) $_GET['offset'];
$tips = getRecentTips($offset, 100);

?>

<?php

include 'includes/html-body-end.php';
