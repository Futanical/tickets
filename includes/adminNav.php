<?php
if (!isset($currentPage)) {
    $currentPage = '';
}
?>

<nav>
    <h1 class="logo">Ticket Support</h1>
    <ul>
        <li>
            <a href="../admin/dashboard.php" class="button hvr-fade" <?php if ($currentPage == 'dashboard.php') { echo 'id="here"'; } ?>>All Tickets</a>
        </li>
        <li>
            <a href="#" class="button hvr-fade" <?php if ($currentPage == 'users.php') { echo 'id="here"'; } ?>>Users</a>
        </li>
        <li>
            <a href="../user/logout.php" class="button hvr-fade">Logout</a>
        </li>
    </ul>
</nav>