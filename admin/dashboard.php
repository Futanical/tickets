<?php

require '../includes/initializeSession.php';
require '../config/config.php';
require '../includes/functions.php';

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

$conn = connect($config);

if ($conn) {

    $error = '';

    $sql = "SELECT first_name FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();
    $firstName = $stmt->fetch();

    $sql = "SELECT tickets.created, ticket_id, ticket_name, ticket_text, open, username, first_name, last_name FROM tickets INNER JOIN users ON users.id = tickets.user_id ORDER BY created DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['username'], PDO::PARAM_STR);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $error = "Connection to the database could not be made. Please try again later.";
}

require '../views/adminDashboard.view.php';

