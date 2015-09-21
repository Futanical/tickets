<?php

// prepare the sql statement
$sql = 'INSERT INTO users (admin, created, username, salt, password, first_name, last_name, picture_url, email_address, address, city, state, zip_code) VALUES(0, now(), :username, :salt, :password, :first_name, :last_name, :picture_url, :email_address, :address, :city, :state, :zip_code)';
$stmt = $conn->prepare($sql);
// bind the parameters
$stmt->bindParam(':username', $username, PDO::PARAM_STR);
$stmt->bindParam(':salt', $salt, PDO::PARAM_INT);
$stmt->bindParam(':password', $password, PDO::PARAM_STR);
$stmt->bindParam(':first_name', $firstName, PDO::PARAM_STR);
$stmt->bindParam(':last_name', $lastName, PDO::PARAM_STR);
$stmt->bindParam(':picture_url', $fileName, PDO::PARAM_STR);
$stmt->bindParam(':email_address', $emailAddress, PDO::PARAM_STR);
$stmt->bindParam(':address', $address, PDO::PARAM_STR);
$stmt->bindParam(':city', $city, PDO::PARAM_STR);
$stmt->bindParam(':state', $state, PDO::PARAM_STR);
$stmt->bindParam(':zip_code', $zipCode, PDO::PARAM_INT);
$stmt->execute();

// if user was registered, unset all variables and clear the $_POST array
if ($stmt->rowCount() == 1) {
    $userRegistered = "$username has been registered. You may now log in" . '<a href="http://localhost:8888/tickets/"> here</a>';
    unset($username);
    unset($biography);
    unset($firstName);
    unset($lastName);
    unset($emailAddress);
    unset($address);
    unset($city);
    unset($state);
    unset($zipCode);
    $_POST = array();
}



