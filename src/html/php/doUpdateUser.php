<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 16:23
 */

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

session_start();

$logicLayer = new LogicLayerImpl();

$firstName = null;
$lastName = null;
$userName = null;
$password = null;
$emailAddress = null;
$studentId = null;
$address = null;
$major = null;

try {
    //update information
    if (trim($_POST['firstName'])) {
        $firstName = trim($_POST['firstName']);
    }
    if (trim($_POST['lastName'])) {
        $lastName = trim($_POST['lastName']);
    }
    if (trim($_POST['password'])) {
        $password = trim($_POST['password']);
        //$password_hash = password_hash($password, PASSWORD_DEFAULT);
    }
    if (trim($_POST['email'])) {
        $emailAddress = trim($_POST['email']);
    }
    if (trim($_POST['studentNumber'])) {
        $studentId = trim($_POST['studentNumber']);
    }
    if (trim($_POST['address'])) {
        $address = trim($_POST['address']);
    }
    if (trim($_POST['major'])) {
        $major = trim($_POST['major']);
    }

    // update user 
    $logicLayer->updateUser(
        $_SESSION['userId'],
        $firstName,
        $lastName,
        null,
        $password,
        $emailAddress,
        $studentId,
        $major,
        $address
    );

    $successMsg = urlencode("User successfully updated!");
    header("Location: ../profile.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../editProfile.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../editProfile.php?status={$errorMsg}");
}
exit();