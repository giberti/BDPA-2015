<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/user.php';

include 'includes/html-body-start.php';

$memberCount = count(getAllUsers());

?>

<div class="container">

    <h1>About Us</h1>

    <p>
        We ride weekly on Sunday between 4pm and 8pm. We welcome riders of all ages and you'll find our upcoming ride
        information on our homepage. Bring your bike and come out and have fun.
    </p>

    <p>
        We were started in 2015 after discovering that a lot of us had the same interest but were lacking in a regularly
        organized group ride. We now have <?php echo number_format($memberCount); ?> members and more people
        <a href="join.php">join</a> us all the time!
    </p>

</div>

<?php

include 'includes/html-body-end.php';
