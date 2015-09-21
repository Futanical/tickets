<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

$conn = connect($config);
$error = '';
$username = '';

// for the menu

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

// for redirect to previous page upon editing a comment, deleting a ticket, etc.

$_SESSION['previousPage'] = $_SERVER['REQUEST_URI'];

$redirect = 'http://localhost:8888/tickets/user/singleTicket.php?id=' . $_GET['id'];

// if the get array is set then process

if (isset($_GET['id'])) {

    // if connection to the db is stable then process

    if ($conn) {

        // fetch the status of the ticket, whether it is open or closed

        $sql = "SELECT open FROM tickets WHERE ticket_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $ticketStatus = $stmt->fetch(PDO::FETCH_ASSOC);

        // fetch just the initial ticket information, no comments here

        $sql = "SELECT ticket_id, ticket_name, ticket_text, picture_url, first_name, last_name FROM tickets INNER JOIN users ON users.id = tickets.user_id WHERE tickets.ticket_id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $ticket = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['ticketId'] = $ticket['ticket_id'];

        // fetch the comments associated with the user and the ticket

        $sql = "SELECT comment, comment_id, users.id, first_name, last_name, picture_url, tickets.ticket_id FROM comments INNER JOIN users ON users.id = comments.user_id INNER JOIN tickets ON tickets.ticket_id = comments.ticket_id WHERE tickets.ticket_id = :id ORDER BY comment_id ASC;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $rowCount = $stmt->rowCount();

        // check admin to see if we can resolve tickets

        if (isset($_SESSION['admin']) && $_SESSION['admin'] === '1') {

            if (isset($_POST['closeTicket']) && $_POST['closeTicket'] === 'Close') {

                $sql = "UPDATE tickets SET open = 0 WHERE tickets.ticket_id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if ($rowCount) {
                    header("Location: $redirect");
                }


            } elseif (isset($_POST['closeTicket']) && $_POST['closeTicket'] === 'Open') {

                $sql = "UPDATE tickets SET open = 1 WHERE tickets.ticket_id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                $stmt->execute();
                $rowCount = $stmt->rowCount();

                if ($rowCount) {
                    header("Location: $redirect");
                }

            }

            if (isset($_POST['deleteTicket'])) {

                // since comments and initial tickets are in separate tables in the database, if there is a comment row then run this query script so it will handle
                // comments and tickets.  otherwise row count will return 0 since we are joining statements and there will be no comments in the join statement thus
                // the query will fail

                if ($rowCount >= 1) {

                    $sql = "DELETE tickets, comments FROM tickets INNER JOIN comments ON comments.ticket_id = tickets.ticket_id WHERE tickets.ticket_id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $rowCount = $stmt->rowCount();

                } else {

                    // if no comments were found run this query to just delete the ticket

                    $sql = "DELETE tickets FROM tickets WHERE tickets.ticket_id = :id";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                    $rowCount = $stmt->rowCount();
                }

                if ($rowCount) {
                    header("Location: http://localhost:8888/tickets/admin/dashboard.php");
                } else {
                    $error = "There was an issue deleting ticket. Please try again later.";
                }
            }

            }

    } else {

        $error = "Could not connect to the database. Please try again later.";

    }

}

include '../views/singleTicket.view.php';