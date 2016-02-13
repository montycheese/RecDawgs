<?php

require_once '../../resources/config.php';
include 'Functions.php';


if(!$_POST){
    Functions::redirect('registration.php?status=error');
}

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
/*
 * This is how to visualize the $_POST array that is sent from the html form on register.php
 * $_POST = ['first_name'=> 'John', 'last_name'=> 'Doe', 'password'=>'password', 'email'=>'joe@example.com' ....]
 * You can access individual members like so:
 * $firstName = $_POST['first_name']
 * echo($firstName)  // John is printed out
 *
 */

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$student_number = $_POST['student_number'];
//define password hash function later
$password_hash = $_POST['password'];
$address = $_POST['address'];
$major = $_POST['major'];

$sql = "INSERT INTO user (first_name, last_name, password_hash, email, student_number, address, major)
VALUES ('{$first_name}', '{$last_name}', '{$password_hash}', '{$email}', '{$student_number}', '$address', '{$major}');";


//$sql = "INSERT INTO user (first_name, last_name, password_hash, email, student_number, address, major)
//VALUES ('$_POST[first_name]', '$_POST[last_name]', '$_POST[password]', '$_POST[email]', '$_POST[student_number]',  '$_POST[address]', '$_POST[major]')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    Functions::redirect('../index.php?status=registersuccess');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>