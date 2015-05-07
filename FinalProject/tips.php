<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/tip.php';

    $pageSize = 10;
    $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;
    $tips = getRecentTips($offset, $pageSize + 1);

    include 'includes/html-body-start.php';

?>
<?php

    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-xs-12">';
    echo '<h1>Bicycling Tips</h1>';
    foreach ($tips as $index => $tip) {
        if ($pageSize == $index + 1) {
            break;
        }
        echo '<div class="row">';
        if (loggedInUser()) {
?>
        <div class="col-xs-2">
            <div class="btn-group-xs">
                <a href="<?php echo getFilename(); ?>?action=edit&tipid=<?php echo $tip['TipID']; ?>" class="btn btn-primary" aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="<?php echo getFilename(); ?>?action=delete&tipid=<?php echo $tip['TipID']; ?>" class="btn btn-danger" aria-label="Left Align" onclick="return confirm('Are you sure you want to delete this tip?');">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>
            </div>
        </div>
        <?php
        }
        echo '<div class="col-xs-10">';
        echo '<strong>' . $tip['Type'] . '</strong> ' . $tip['Text'];
        echo '</div>';
        echo '</div>';
    }

    // Show pagination information
    echo '<p>';
    if ($offset > 0) {
        echo '<a href="' . getFilename() . '?offset=' . ($offset - $pageSize) . '"> &lt; Back</a>';
        echo ' ';
    }
    if (count($tips) > $pageSize) {
        echo '<a href="' . getFilename() . '?offset=' . ($offset + $pageSize) . '">Next &gt;</a>';
    }
    echo '</p>';
    echo '</div>';
    echo '</div>';
    echo '</div>';

    include 'includes/html-body-end.php';
