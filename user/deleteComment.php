<?php

require '../includes/initializeSession.php';
require '../config/config.php';

// connect to the db

$conn = connect($config);

// if connection is stable then process

if ($conn) {

    $sql = "DELETE FROM comments WHERE comment_id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
    $stmt->execute();
    $rowCount = $stmt->rowCount();

    // if row count returns true then redirect user to the previous page

    if ($rowCount) {

        header("Location: $_SESSION[previousPage]");

    } else {

        $error = "There was an issue deleting comment. Please try again later.";

    }
}
