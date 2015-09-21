<?php

require './config/db.php';
require './models/authUser.php';
require './includes/functions.php';

$database = new Database();
$conn = $database->connect();

$error = '';

if (isset($_POST['login'])) {

    if ($conn) {

        session_start();

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        // location to redirect on success

        $userRedirect = 'http://localhost:8888/tickets/user/dashboard.php';
        $adminRedirect = 'http://localhost:8888/tickets/admin/dashboard.php';

        // authenticate the user

        $authUser = new AuthUser($username);
        $salt = $authUser->getSalt($conn);
        $storedPassword = $authUser->getPassword($conn);

        // compared the input password to the stored password in the database, if they match then continue on.  if not, set an error variable

        if (sha1($password . $salt) == $storedPassword) {

            // check to see if the user is an admin
            $sql = "SELECT admin FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindColumn('admin', $admin);
            $stmt->execute();
            $stmt->fetch(PDO::FETCH_BOUND);

            // get the user id to set it to a session variable

            $sql = "SELECT id FROM users WHERE username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindColumn('id', $userId);
            $stmt->execute();
            $stmt->fetch(PDO::FETCH_BOUND);

            // get the first name of the user to set it to a session variable

            $sql = "SELECT first_name FROM users where username = :username";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // set the session variables

            $_SESSION['authenticated'] = 'Authenticated';
            $_SESSION['start'] = time();
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['admin'] = $admin;
            $_SESSION['userId'] = $userId;
            $_SESSION['firstName'] = $row['first_name'];

            // check if user is an admin and redirect accordingly

            if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {
                header("Location: $adminRedirect");
            } else {
                header("Location: $userRedirect");
                exit;
            }
        } else {
            $error = 'Invalid username or password';
        }
    } else {
        $error = "Connection could not be made to the database. Please try again later.";
    }
}

include 'views/index.php';