<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/user.php';
    require 'includes/route.php';
    require 'includes/tip.php';

    include 'includes/html-body-start.php';

    // Get the data that we'll want to display on the homepage
    $newTips = getRecentTips(0,10);
    $upcomingRoutes = getUpcomingRoutes(0,4);

?>

<div class="container">

</div>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Upcoming Rides</h2>
            <?php
                // Rides are at 4pm on Sunday
                $daysUntilRide = 7 - date('N');
                $sunday = time() + ($daysUntilRide * 86400); // there are 86,400 seconds in a day
                if ($daysUntilRide === 0) { // if today is sunday...
                    if (date('H') >= 16) { // and its after 4pm
                        // Next ride isn't this week anymore, it's next week
                        $sunday = time() + (7 * 86400); // there are 86,400 seconds in a day
                    }
                }

                // Loop over each ride that we have coming up
                foreach ($upcomingRoutes as $index => $route) {
                    if ($index == 0) {
                        // make this ride stand out as more important
                        echo '<h4>' . date('F d, Y', $sunday) . ' at 4pm: ' . $route['Name'] .  '</h4>';
                        if ($route['MapImageURL']) {
                            echo '<img src="' . $route['MapImageURL'] .'"/>';
                        }
                        echo '<p>' . $route['Type'] . ' ' . round($route['Distance'], 1) . ' miles</p>';
                        echo '<p>' . $route['Description'] . '</p>';
                    } else {
                        // Rides further out can be displayed without as much attention
                        echo '<h5>' . date('F d, Y', $sunday) . ' at 4pm: ' . $route['Name'] .  '</h5>';
                        echo '<p>' . $route['Type'] . ' ' . round($route['Distance'], 1) . ' miles</p>';
                        echo '<p>' . $route['Description'] . '</p>';
                    }
                    $sunday += (7 * 86400); // add a week before going through the loop again
                }

            ?>
            <p><a href="routes.php">Looking for a specific route?</a></p>
        </div>
        <div class="col-md-6">
            <h2>New Tips</h2>
            <ul>
                <?php
                foreach ($newTips as $tip) {
                    echo '<li>' . $tip['Type'] . ': ' . $tip['Text'] . '</li>';
                }
                ?>
            </ul>
            <p><a href="tips.php">See all our cycling tips</a></p>
        </div>
    </div>
</div>

<?php

    include 'includes/html-body-end.php';
