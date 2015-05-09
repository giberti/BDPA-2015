<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/tip.php';

    $pageSize = 10;
    $offset = isset($_GET['offset']) ? (int) $_GET['offset'] : 0;

    include 'includes/html-body-start.php';

    // Are we workingo on a tip?
    $editTip = false;
    if (loggedInUser() && isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'edit':
                $editTip = getTipById($_GET['TipID']);
                break;
            case 'save':
                if (!$_POST['TipID']) {
                    // new tip
                    addTip(getUserID(), $_POST['Type'], $_POST['Text']);
                } else {
                    // editing an existing tip
                    updateTip($_POST['TipID'], $_POST['UserID'], $_POST['Type'], $_POST['Text']);
                }
                break;
            case 'delete':
                if (isset($_GET['TipID']) && $_GET['TipID'] > 0) {
                    deleteTip($_GET['TipID']);
                }
                break;
        }
    }

    // Get remaining data for this page
    $tips = getRecentTips($offset, $pageSize + 1);

    // If this user is logged in, show the add/edit tip form
    if (loggedInUser()) {
        $displayStyle = 'none';

        $tipfields = array(
            'TipID' => '',
            'UserID' => '',
            'Type' => 'Type',
            'Text' => 'Tip Text'
        );

        if ($editTip) {
            $displayStyle = 'block';
        }

        echo '<div class="container" id="addEditForm" style="display:' . $displayStyle. ';">';
        echo '<form action="' . getFilename() . '?action=save" method="post">';
        if ($editTip) {
            echo '<h2>Editing this tip</h2>';
        } else {
            echo '<h2>Add a new tip!</h2>';
        }

        foreach ($tipfields as $fieldname => $label) {
            $value = '';
            if ($editTip) {
                $value = htmlentities($editTip[$fieldname]);
            }
            if ($label == '') {
                echo '<input type="hidden" name="' . $fieldname . '" value="' . $value . '" />';
            } else if ($fieldname == 'Type') {
                // @todo select box
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
                echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
                echo "</div>";
            } else if ($fieldname == 'Text') {
                // @todo textarea
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
                echo "<textarea class=\"form-control\" name=\"{$fieldname}\" id=\"input{$fieldname}\" placeholder=\"$label\" rows=\"3\" required>{$value}</textarea>";
                echo "</div>";
            } else {
                echo "<div class=\"form-group\">";
                echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
                echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
                echo "</div>";
            }
        }
        echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Save</button>';
        echo '</form>';
        echo '</div>';
    }

    // Now just show other tips
    echo '<div class="container">';
    echo '<div class="row">';
    echo '<div class="col-xs-12">';
    echo '<h1>Bicycling Tips</h1>';
    if (loggedInUser() && !$editTip) {
        echo '<p>';
        echo '<a id="addNewLink" onclick="showAddEditForm();">Add new tip</a>';
        echo '</p>';
    }
    foreach ($tips as $index => $tip) {
        if ($pageSize == $index + 1) {
            break;
        }
        echo '<div class="row">';
        if (loggedInUser()) {
?>
        <div class="col-xs-2">
            <div class="btn-group-xs">
                <a href="<?php echo getFilename(); ?>?action=edit&TipID=<?php echo $tip['TipID']; ?>&offset=<?php echo $offset; ?>" class="btn btn-primary" aria-label="Left Align">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>
                <a href="<?php echo getFilename(); ?>?action=delete&TipID=<?php echo $tip['TipID']; ?>&offset=<?php echo $offset; ?>" class="btn btn-danger" aria-label="Left Align" onclick="return confirm('Are you sure you want to delete this tip?');">
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
