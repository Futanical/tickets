<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

// connect to the db

$conn = connect($config);

// for the menu

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
$redirect = '../views/ticketSubmitted.php';

// initialize the error variable

$error = '';

if (isset($_POST['submit'])) {

    if ($conn) {

        // dump the $_POST information into variable for ease of use when binding params

        $ticketName = $_POST['ticketName'];
        $ticketBody = htmlentities($_POST['ticketBody']);

        // ticket will always be set to open upon creation
        $open = 1;

        // run query to insert the ticket into the db

        $sql = "INSERT INTO tickets (created, ticket_name, ticket_text, open, user_id) VALUES(now(), :ticketName, :ticketBody, :open, :id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ticketName', $ticketName, PDO::PARAM_STR);
        $stmt->bindParam(':ticketBody', $ticketBody, PDO::PARAM_STR);
        $stmt->bindParam(':open', $open, PDO::PARAM_INT);
        $stmt->bindParam(':id', $_SESSION['userId'], PDO::PARAM_INT);
        $stmt->execute();
        $rowCount = $stmt->rowCount();

        // if row count returns true then redirect user else echo error

        if ($rowCount) {

            header("Location: $redirect");

        } else {

            $error = "There was a problem. Please try submitting your ticket later.";

        }

    } else {

        $error = "Could not connect to the database. Please try again later.";

    }
}

require '../views/createTicket.view.php';



