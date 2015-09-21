<?php

class Database {

    protected $config = array();

    public function __construct() {
        $this->config['username'] = 'root';
        $this->config['password'] = 'root';
    }

    public function connect() {
        try {
            $conn = new PDO('mysql:host=localhost;dbname=tickets', $this->config['username'], $this->config['password']);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch (Exception $e) {
            return false;
        }
    }

    public function error($error) {
        if (isset($error)) {
            return $error;
        }
    }
}