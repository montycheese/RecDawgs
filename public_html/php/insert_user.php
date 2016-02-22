<?php

require_once '../../resources/config.php';
require_once('Models/User.php');
include 'Functions.php';


if(!$_POST){
    Functions::redirect('registration.php?status=error');
}

/*
 * This is how to visualize the $_POST array that is sent from the html form on register.php
 * $_POST = ['firstName'=> 'John', 'lastName'=> 'Doe', 'password'=>'password', 'email'=>'joe@example.com' ....]
 * You can access individual members like so:
 * $firstName = $_POST['firstName']
 * echo($firstName)  // John is printed out
 *
 */

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$studentNumber = $_POST['studentNumber'];
//define password hash function later
$passwordHash = $_POST['password'];
$address = $_POST['address'];
$major = $_POST['major'];


$user = new User(
    $firstName, $lastName, $email, $studentNumber, $passwordHash, $address, $major
);

if($user->register() == true){
    echo "New record created successfully";
    Functions::redirect('../index.php?status=register_success');
}
else{
    echo "Error: ";
    Functions::redirect('../register.php?status=error2');
}


?>