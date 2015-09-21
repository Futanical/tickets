<?php

require '../config/db.php';
require '../models/signUp.php';
require '../includes/functions.php';

// connect to the database
$database = new Database();
$conn = $database->connect();

$missing = array();

// set maximum upload size in bytes
$max = 5120000;

if (isset($_POST['register'])) {

    if ($conn) {

        // initialize variables for ease of use
        $username = $_POST['username'];
        $password = $_POST['password'];
        $reTyped = $_POST['confirmPassword'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $emailAddress = $_POST['emailAddress'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zipCode = $_POST['zipCode'];

        // set the required array for the form and initialize username for use in the class
        $signUp = new SignUp($username, $password, $firstName, $lastName, $emailAddress, $address, $city, $state, $zipCode);
        $usernameRowCount = $signUp->usernameCheck($conn);

        // if username duplicate wasn't found, then row count will return 0
        if ($usernameRowCount === 0) {

            // check the username and password to make sure they meet minimum criteria
            require_once '../classes/checkUsername.php';
            require_once '../classes/checkPassword.php';

            $checkUsername = new checkUsername($username);
            $usernameOK = $checkUsername->checkUsername();

            if (!$usernameOK) {
                $usernameResult = $checkUsername->getErrors();
            }

            $checkPassword = new checkPassword($password, $reTyped);
            $checkPassword->requireNumbers(0);
            $checkPassword->requireSymbols(0);
            $passwordOK = $checkPassword->check();

            if (!$passwordOK) {
                $passwordResult = $checkPassword->getErrors();
            }

            $missing = $signUp->checkForm();
            $validEmail = $signUp->validateEmail();

            if (!$validEmail) {
                $invalidEmail = "Your email address is not valid.";
            }

            // if password and username are ok and nothing is in the $missing array and the email is valid then upload the image
            if ($passwordOK && $usernameOK && !$missing && $validEmail) {

                $destination = '../../tickets/img/uploads/';

                require_once '../classes/imageUpload.php';
                require_once '../classes/resizeImage.php';
                require_once '../classes/resizeUpload.php';

                $resizeUpload = new resizeUpload($destination);
                $resizeUpload->setThumbDestination($destination);
                $fileName = $resizeUpload->move();
                $imageUploadResult = $resizeUpload->getMessages();

                // if $fileName is set then image uploaded successfully and we can dump the users info into the database
                if (isset($fileName)) {
                    $insertUserRowCount = $signUp->insertUser($fileName, $conn);

                    if ($insertUserRowCount === 1) {
                        $userRegistered = $signUp->unsetVariables();
                    }
                }
            }
        } else {
            $registerResult = "$username is taken.  Please choose another username.";
        }
    } else {
        $error = "Could not connect to the database. Please try again later.";
    }
}

include '../views/signUp.php';

