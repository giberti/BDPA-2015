<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/user.php';

?>
<html>
<head>
    <title>BDPA Bicycle Club</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bdpa-specific.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">BDPA SEMN Bicycling Club</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    // Create the navigation items from an array
                    $navItems = array(
                        'index.php' => 'Home',
                        'about.php' => 'About',
                        'join.php'  => 'Join',
                    );
                    if (!loggedInUser()) {
                        $navItems['login.php'] = 'Login';
                    } else {
                        $navItems['logout.php'] = 'Logout';
                    }
                    foreach ($navItems as $filename => $label) {
                        if ($filename == getFilename()) {
                            echo "<li class=\"active\"><a href=\"{$filename}\">{$label}</a></li>";
                        } else {
                            echo "<li><a href=\"{$filename}\">{$label}</a></li>";
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>



    <footer class="footer">
        <div class="container">
            <p class="text-muted">
                &copy; <?php echo date('Y'); ?>BDPA SEMN Bicycle Club<br />
                <a href="http://www.bdpa.org/" target="_blank">Learn more about BDPA and find a chapter near you</a>
            </p>
        </div>
    </footer>

    <!-- jQuery and Bootstrap -->
    <script src="js/jquery-2.1.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>