<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

// connect to the db

$conn = connect($config);

// initialize the error variable

$error = '';

// if get variable is set then continue

if (isset($_GET['id'])) {

    // if connection to db is stable then process

    if ($conn) {

        $sql = "SELECT ticket_text FROM tickets WHERE ticket_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (isset($_POST['submit'])) {

            $ticketBody = $_POST['ticketBody'];

            $sql = "UPDATE tickets SET ticket_text = :ticket_text WHERE ticket_id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':ticket_text', $ticketBody, PDO::PARAM_STR);
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->execute();

            header("Location: $_SESSION[previousPage]");
        }

    } else {
        $error = "Could not connect to the database. Please try again later.";
    }

}

include '../views/editTicket.view.php';
