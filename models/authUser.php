<?php

class AuthUser
{

    protected $username;
    protected $storedPassword;
    protected $salt = '';
    protected $session = array();

    public function __construct($username)
    {
        $this->username = $username;
    }

    public function getSalt($conn)
    {

        $sql = 'SELECT salt FROM users WHERE username = :username';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindColumn('salt', $this->salt);
        $stmt->execute();
        $stmt->fetch();

        return $this->salt;
    }

    public function getPassword($conn)
    {

        $sql = 'SELECT password FROM users WHERE username = :username';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindColumn('password', $this->storedPassword);
        $stmt->execute();
        $stmt->fetch();

        return $this->storedPassword;
    }

}