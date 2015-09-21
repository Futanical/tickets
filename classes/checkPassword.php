<?php

class checkPassword {

    protected $password;
    protected $reTyped;
    protected $minChars;
    protected $mixedCase = false;
    protected $minNumbers = 0;
    protected $minSymbols = 0;
    protected $errors = array();

    public function __construct($password, $reTyped, $minChars = 8) {
        $this->password = $password;
        $this->minChars = $minChars;
        $this->reTyped = $reTyped;
    }

    public function requireMixedCase() {
        $this->mixedCase = false;
    }

    public function requireNumbers($num = 1) {
        if (is_numeric($num) && $num > 0) {
            $this->minNumbers = (int) $num;
        }
    }

    public function requireSymbols($num = 1) {
        if (is_numeric($num) && $num > 0) {
            $this->minSymbols = (int) $num;
        }
    }

    public function check() {
        if ($this->password != $this->reTyped) {
            $this->errors[] = "Your password's don't match.";
        }

        if (preg_match('/\s/', $this->password)) {
            $this->errors[] = 'Password cannot contain spaces.';
        }

        if (strlen($this->password) < $this->minChars) {
            $this->errors[] = "Password must be at least $this->minChars characters.";
        }

        if ($this->mixedCase) {
            $pattern = '/(?=.*[a-z])(?=.*[A-Z])/';

            if (!preg_match($pattern, $this->password)) {
                $this->errors[] = 'Password should include uppercase and lowercase characters.';
            }
        }

        if ($this->minNumbers) {
            $pattern = '/\d/';
            $found = preg_match_all($pattern, $this->password, $matches);

            if ($found < $this->minNumbers) {
                $this->errors[] = "Password should include at least $this->minNumbers number(s).";
            }
        }

        if ($this->minSymbols) {
            $pattern = "/[-!$%^&*(){}<>[\]'" . '"|#@:;.,?+=_\/\~]/';
            $found = preg_match_all($pattern, $this->password, $matches);

            if ($found < $this->minSymbols) {
                $this->errors[] = "Password should include at least $this->minSymbols nonalphanumeric character(s).";
            }
        }

        return $this->errors ? false : true;
    }

    public function getErrors() {
        return $this->errors;
    }


}