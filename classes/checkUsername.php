<?php

class checkUsername {
    protected $username;
    protected $minChars;
    protected $errors = array();

    public function __construct($username, $minChars = 6) {
        $this->username = $username;
        $this->minChars = $minChars;
    }

    public function checkUsername() {
        if (preg_match('/\s/', $this->username)) {
            $this->errors[] = 'Username cannot contain spaces.';
        }

        if (strlen($this->username) < $this->minChars) {
            $this->errors[] = "Username must be at least $this->minChars characters.";
        }

        return $this->errors ? false : true;
    }

    public function getErrors() {
        return $this->errors;
    }
}
