<?php

session_start();

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);

// if session variable has not been set, redirect to login page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] != 'Authenticated') {
    header("Location: http://localhost:8888/tickets/");
    exit;
}

header("refresh:5;url=http://localhost:8888/tickets/user/dashboard.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Support</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/hover.css">
    <link rel="stylesheet" href="../css/hover-min.css">
    <script src="../ckeditor/ckeditor.js"></script>
</head>
<body>
<header>
    <nav>
        <h1 class="logo">Ticket Support</h1>
        <ul>
            <li>
                <a href="../user/dashboard.php" class="button hvr-fade" <?php if ($currentPage == 'dashboard.php') { echo 'id="here"'; } ?>>My Tickets</a>
            </li>
            <li>
                <a href="../user/createTicket.php" class="button hvr-fade" <?php if ($currentPage == 'createTicket.php' || 'ticketSubmitted.php') { echo 'id="here"'; } ?>>Submit Ticket</a>
            </li>
            <li class="end">
                <a href="../user/logout.php" class="button hvr-fade">Logout</a>
            </li>
        </ul>
    </nav>
</header>
<section class="tickets">
        <div class="no-tickets">
            <h1 class="ticket-submitted-header">Thank You</h1>
            <p class="ticket-submitted-paragraph">Your ticket has been submitted.</a></p>
        </div>
</section>
</body>
</html>