<?php
if (!isset($currentPage)) {
    $currentPage = '';
}
?>

<nav>
    <h1 class="logo">Ticket Support</h1>
    <ul>
        <li>
            <a href="../user/dashboard.php" class="button hvr-fade" <?php if ($currentPage == 'dashboard.php') { echo 'id="here"'; } ?>>My Tickets</a>
        </li>
        <li>
            <a href="../user/createTicket.php" class="button hvr-fade" <?php if ($currentPage == 'createTicket.php') { echo 'id="here"'; } ?>>Submit Ticket</a>
        </li>
        <li>
            <a href="../user/logout.php" class="button hvr-fade">Logout</a>
        </li>
    </ul>
</nav>