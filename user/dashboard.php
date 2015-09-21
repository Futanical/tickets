<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

// for the menu

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

// connect the db

$conn = connect($config);

// initialize error variable

$error = '';

if ($conn) {

    // fetch ticket information

    $sql = "SELECT tickets.created, ticket_id, ticket_name, open, first_name FROM tickets INNER JOIN users ON users.id = tickets.user_id WHERE username = :username ORDER BY created DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {

    $error = "Connection to the database could not be made. Please try again later.";

}

require '../views/dashboard.view.php';


