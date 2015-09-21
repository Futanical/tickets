<?php

// run script only if logout button has been clicked
    session_start();
    // empty the session array
    $_SESSION = array();
    // invalidate the session cookie
    if (isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 86400, '/');

        // end session and redirect
        session_destroy();
        header('Location: http://localhost:8888/tickets/');
}