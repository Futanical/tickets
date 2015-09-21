<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

// connect to the db

$conn = connect($config);

// initialize the error variable

$error = '';

// if post array is set then process

if (isset($_POST['submit'])) {

    // if connection to the db is stable then process

    if ($conn) {

        // dump post array value into the commentBody variable

        $commentBody = $_POST['commentBody'];

        $sql = "SELECT id FROM users WHERE username = :username";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
        $stmt->execute();
        $userRowId = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "INSERT INTO comments (comment, user_id, ticket_id) VALUES(:comment, :user_id, :ticket_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':comment', $commentBody, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $userRowId['id'], PDO::PARAM_INT);
        $stmt->bindParam(':ticket_id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {

            $sql = "UPDATE tickets SET open = 1 WHERE tickets.ticket_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();

            $to = 'houston@houstonmolinar.com';
            $subject = 'the subject';
            $message = 'hello';
            $headers = 'From: webmaster@example.com' . "\r\n" . 'Reply-To: webmaster@example.com' . "\r\n" . 'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

            header("Location: $_SESSION[previousPage]");

        }

    } else {
        $error = "Could not connect to the database. Please try again later.";
    }
}

require '../views/comment.view.php';