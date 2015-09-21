<?php

foreach ($_POST as $key => $value) {
    // assign to temporary variable and strip whitespace
    if (is_array($value)) {
        $temp = $value;
    } else {
        $temp = trim($value);
    }

    // if empty and required, add to $missing array
    if (empty($temp) && in_array($key, $signUp)) {
        $missing[] = $key;
    }
}

// validate the user's email
if ($_POST) {
    $validEmail = filter_input(INPUT_POST, 'emailAddress', FILTER_VALIDATE_EMAIL);

    if (!$validEmail) {
        $invalidEmail = "Your email address is not valid.";
    }
}

