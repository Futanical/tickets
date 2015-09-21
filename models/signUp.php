<?php

class SignUp {

    public $required = array();
    protected $username;
    public $missing = array();
    protected $salt;
    protected $password;
    protected $firstName;
    protected $lastName;
    protected $fileName;
    protected $emailAddress;
    protected $address;
    protected $city;
    protected $state;
    protected $zipCode;

    public function __construct($username, $password, $firstName, $lastName, $emailAddress, $address, $city, $state, $zipCode) {

        $this->required = array('firstName', 'lastName', 'emailAddress', 'address', 'city', 'state', 'zipCode');
        $this->salt = time();
        $this->password = sha1($password . $this->salt);
        $this->username = $username;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->emailAddress = $emailAddress;
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zipCode = $zipCode;
        return $this->required;
    }

    public function usernameCheck($conn) {

        // check to see if username is already registered
        $sql = 'SELECT * FROM users WHERE username = :username';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function checkForm() {

        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                $temp = $value;
            } else {
                $temp = trim($value);
            }

            if (empty($temp) && in_array($key, $this->required)) {
                $this->missing[] = $key;
            }
        }

        return $this->missing;
    }

    public function validateEmail() {

        if ($_POST) {
            return $validEmail = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);
        }

        return '';
    }

    public function insertUser($fileName, $conn) {

        $this->fileName = $fileName;

        $sql = 'INSERT INTO users (admin, created, username, salt, password, first_name, last_name, picture_url, email_address, address, city, state, zip_code) VALUES(0, now(), :username, :salt, :password, :first_name, :last_name, :picture_url, :email_address, :address, :city, :state, :zip_code)';
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $this->username, PDO::PARAM_STR);
        $stmt->bindParam(':salt', $this->salt, PDO::PARAM_INT);
        $stmt->bindParam(':password', $this->password, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $this->firstName, PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $this->lastName, PDO::PARAM_STR);
        $stmt->bindParam(':picture_url', $this->fileName, PDO::PARAM_STR);
        $stmt->bindParam(':email_address', $this->emailAddress, PDO::PARAM_STR);
        $stmt->bindParam(':address', $this->address, PDO::PARAM_STR);
        $stmt->bindParam(':city', $this->city, PDO::PARAM_STR);
        $stmt->bindParam(':state', $this->state, PDO::PARAM_STR);
        $stmt->bindParam(':zip_code', $this->zipCode, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function unsetVariables() {

        $userRegistered = "$this->username has been registered. You may now log in" . '<a href="http://localhost:8888/tickets/"> here</a>';
        unset($this->username);
        unset($this->firstName);
        unset($this->lastName);
        unset($this->emailAddress);
        unset($this->address);
        unset($this->city);
        unset($this->state);
        unset($this->zipCode);
        $_POST = array();

        return $userRegistered;
    }
}