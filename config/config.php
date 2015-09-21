<?php

$config = array(
    'username' => 'root',
    'password' => 'root'
);

function connect($config) {
    try {
        $conn = new PDO('mysql:host=localhost;dbname=tickets', $config['username'], $config['password']);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (Exception $e) {
        return false;
    }
}