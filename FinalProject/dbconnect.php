<?php

	// include the passwords and db configuration
	require 'setup.php';

    // connect to the db server
	$mysql = mysqli_connect($db_server, $db_username, $db_password, $db_schema);
    if (!$mysql) {
        die("Unable to connect to database server");
    }