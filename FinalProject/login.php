<?php

    require 'includes/session.php';
    require 'dbconnect.php';
    require 'includes/functions.php';
    require 'includes/user.php';

    $emailPlaceholder = 'Email address';
    $emailValue = '';
    $errorMessage = '';

    // Did the user attempt to login? check, see if the login is valid
    if (!empty($_POST['emailaddress']) && !empty($_POST['password'])) {
        // $user will be false if the login isn't valid
        $user = getUserByLogin($_POST['emailaddress'], $_POST['password']);
        if ($user) {
            loginUser($user);
        }

        // If the login failed, we want to make the user's life easier and provide
        // them with a message and prepopulate the value of the email address
        $emailPlaceholder = '';
        $emailValue = htmlentities($_POST['emailaddress']);
        $errorMessage = 'Your login was incorrect, please try again.';
    }

    // if the user is logged in already, take them to the homepage
    if (loggedInUser()) {
        header('Location: index.php');
    }

    include 'includes/html-body-start.php';

?>

    <div class="container">
        <div class="row">

            <!-- left half of the page -->
            <div class="col-xs-6">
                <form class="form-signin" method="post" action="<?php echo getFilename(); ?>">

                    <h2 class="form-signin-heading">Please sign in</h2>
                    <?php
                    if ($errorMessage) {
                        echo "<p class=\"bg-danger\">{$errorMessage}</p>";
                    }
                    ?>

                    <div class="form-group">
                        <label for="inputEmail">Email address</label>
                        <input type="text" name="emailaddress" id="inputEmail" class="form-control" placeholder="<?php echo $emailPlaceholder; ?>" value="<?php echo $emailValue; ?>" required autofocus>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword">Password</label>
                        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                </form>
            </div>

            <!-- right half of the page -->
            <div class="col-xs-6">
                <h3>Not a member yet?</h3>
                <a href="join.php">Join our club</a>, it's the best!
            </div>
        </div>
    </div>

<?php

include 'includes/html-body-end.php';