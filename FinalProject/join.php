<?php

require 'includes/session.php';
require 'dbconnect.php';
require 'includes/functions.php';
require 'includes/user.php';
require 'includes/bicycle.php';


$userFormFields = array(
    'firstname' => 'First Name',
    'lastname' => 'Last Name',
    'address' => 'Address',
    'city' => 'City',
    'state' => 'State',
    'zipcode' => 'Zip Code',
    'phonenumber' => 'Phone Number',
    'age' => 'Age',
);

$bicycleFormFields = array(
    'manufacturer' => 'Manufacturer',
    'type' => 'Type',
    'speeds' => 'Speeds',
    'tiresizeinches' => 'Tire Size (inches)',
);

// some default state
$fieldsInError = array();
$emailaddress = '';

// If this was a post, see if they're trying to create an account.
if (!empty($_POST['emailaddress']) && !empty($_POST['password'])) {
    // Are all the user and bicycle fields present?
    foreach(array_merge($userFormFields, $bicycleFormFields) as $fieldname => $label) {
        $value = trim($_POST[$fieldname]);
        if (empty($value)) {
            $fieldsInError[] = $fieldname;
        }
    }
    // Do we have an email address?
    $emailaddress = trim($_POST['emailaddress']);
    if (empty($emailaddress)) {
        $fieldsInError[] = 'emailaddress';
    }
    // Do the two passwords match?
    if ($_POST['password'] != $_POST['password2']) {
        $fieldsInError[] = 'password';
        $fieldsInError[] = 'password2';
    }

    // No errors, lets add the user
    if (empty($fieldsInError)) {
        $user = addUser(
            $_POST['emailaddress'],
            $_POST['password'],
            $_POST['firstname'],
            $_POST['lastname'],
            $_POST['age'],
            $_POST['address'],
            $_POST['city'],
            $_POST['state'],
            $_POST['zipcode'],
            $_POST['phonenumber'],
            '' // image
        );
        if ($user) {
            loginUser($user);
            addBicycle(
                $user['UserID'],
                $_POST['manufacturer'],
                $_POST['type'],
                $_POST['speeds'],
                $_POST['tiresizeinches'],
                '' // image
            );
            header('Location: index.php');
        }
    }
}

include 'includes/html-body-start.php';

?>

<div class="container">
    <h2>Sign up</h2>
    <p>Complete the form below to become a member of our club. All fields are required.</p>
    <div class="row">
        <form method="post" action="<?php echo getFilename(); ?>">
            <div class="col-md-6">
                <h2>About You</h2>
                <?php
                    foreach($userFormFields as $fieldname => $label) {
                        $errorState = '';
                        if (in_array($fieldname, $fieldsInError)) {
                            $errorState = ' has-error';
                        }
                        $value = (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) ? htmlentities($_POST[$fieldname]) : null;
                        echo "<div class=\"form-group {$errorState}\">";
                        echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
                        echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
                        echo "</div>";
                    }
                ?>

            </div>
            <div class="col-md-6">
                <h2>About your Bike</h2>
                <?php
                    foreach($bicycleFormFields as $fieldname => $label) {
                        $errorState = '';
                        if (in_array($fieldname, $fieldsInError)) {
                            $errorState = ' has-error';
                        }
                        $value = (isset($_POST[$fieldname]) && !empty($_POST[$fieldname])) ? htmlentities($_POST[$fieldname]) : null;
                        echo "<div class=\"form-group {$errorState}\">";
                        echo "<label class=\"control-label\" for=\"input{$fieldname}\">{$label}</label>";
                        echo "<input type=\"text\" name=\"{$fieldname}\" id=\"input{$fieldname}\" class=\"form-control\" placeholder=\"{$label}\" value=\"{$value}\" required>";
                        echo "</div>";
                    }
                ?>

                <h2>Login Information</h2>

                <?php
                    $errorState = '';
                    if (in_array('emailaddress', $fieldsInError)) {
                        $errorState = ' has-error';
                    }
                ?>
                <div class="form-group">
                    <label class="control-label" for="inputEmail">Email address</label>
                    <input type="email" name="emailaddress" id="inputEmail" class="form-control" placeholder="Email address" value="<?php echo htmlentities($emailaddress); ?>" required>
                </div>

                <?php
                    $errorState = '';
                    if (in_array('password', $fieldsInError)) {
                        $errorState = ' has-error';
                    }
                ?>
                <div class="form-group<?php echo $errorState; ?>">
                    <label class="control-label" for="inputPassword">Password</label>
                    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
                </div>

                <div class="form-group<?php echo $errorState; ?>">
                    <label class="control-label" for="inputPassword2">Password (again)</label>
                    <input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="Password (again)" required>
                </div>

            </div>
    </div>
    <div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
    </div>
    </form>
</div>

<?php

include 'includes/html-body-end.php';
