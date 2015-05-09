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
                        echo '<h4><a href="route.php?RouteID=' . $route['RouteID'] . '">' . htmlentities($route['Name']) .  '</a></h4>';
                        echo '<div class="media">';
                        echo '<div class="media-left">';
                        if (!empty($route['MapImageURL'])) {
                            echo '<a href="route.php?RouteID=' . $route['RouteID'] . '">';
                            echo '<img class="media-object" src="' . $route['MapImageURL'] .'" height="150" />';
                            echo '</a>';
                        }
                        echo '</div>';
                        echo '<div class="media-body">';
                        echo '<p>' . date('F d, Y', $sunday) . ' at 4pm</p>';
                        echo '<p>' . htmlentities($route['Type']) . ' ' . round($route['Distance'], 1) . ' miles</p>';
                        if (strlen($route['Description']) < 120) {
                            echo '<p>' . htmlentities($route['Description']) . '</p>';
                        } else {
                            echo '<p>' . htmlentities(substr($route['Description'],0,130)) . '...</p>';
                        }
                        echo '</div>';
                        echo '</div>';
                    } else {
                        // Rides further out can be displayed without as much attention
                        echo '<div class="route-homepage-secondary">';
                        echo '<h5><a href="route.php?RouteID=' . $route['RouteID'] . '">' . htmlentities($route['Name'])  .  '</a> on ' . date('F d, Y', $sunday) . '</h5>';
                        echo '<p>' . htmlentities($route['Type']) . ' ' . round($route['Distance'], 1) . ' miles</p>';
                        if (strlen($route['Description']) < 120) {
                            echo '<p>' . htmlentities($route['Description']) . '</p>';
                        } else {
                            echo '<p>' . htmlentities(substr($route['Description'],0,130)) . '...</p>';
                        }
                        echo '</div>';
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
