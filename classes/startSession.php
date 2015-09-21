<?php

class startSession {
    public function __construct() {

        session_start();

        if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] != 'Authenticated') {
            header("Location: http://localhost:8888/tickets/");
            exit;

        }
    }
}