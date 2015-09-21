<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

// connect to to the db

$conn = connect($config);

// initialize the error variable

$error = '';

// if get variable is set, then continue

if (isset($_GET['id'])) {

    // if connection to db is stable then process

    if ($conn) {

        // fetch the comments based on comment id

        $sql = "SELECT comment FROM comments WHERE comment_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($_POST['submit'])) {

            // if comment has been been submitted grab the $_POST info and set it to the $ticketBody then run the update query to the db

            $ticketBody = $_POST['ticketBody'];

            $sql = "UPDATE comments SET comment = :comment WHERE comment_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':comment', $ticketBody, PDO::PARAM_STR);
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();
            $rowCount = $stmt->rowCount();

            // if row count returns true then we can redirect to previous page

            if ($rowCount) {

                header("Location: $_SESSION[previousPage]");

            } else {

                $error = "There was an editing your comment. Please try again later.";

            }

        }

    } else {

        $error = "Could not connect to the database. Please try again later.";

    }

}

include '../views/editComment.view.php';
