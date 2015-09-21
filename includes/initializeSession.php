<?php

session_start();

// if session variable has not been set, redirect to login page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] != 'Authenticated') {
    header("Location: http://localhost:8888/tickets/");
    exit;
}