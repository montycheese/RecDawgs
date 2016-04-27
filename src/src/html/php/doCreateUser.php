<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:56
 */


require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
//die(var_dump($_POST));
//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../teams.php?status={$errorMsg}");
        exit();
    }
}
try {
    //trim any whitespace
    $firstName = trim($_POST['firstName']);
    $lastName = trim($_POST['lastName']);
    $userName = trim($_POST['userName']);
    $password = trim($_POST['password']);
    $emailAddress = trim($_POST['email']);
    $studentId = trim($_POST['studentNumber']);
    $address = trim($_POST['address']);
    $major = trim($_POST['major']);

    // this code is used to hash the password into DB. when we register a user.
    $password_hash = $password; //TODO REIMPLEMENT HASH password_hash($password, PASSWORD_DEFAULT);

    //store the user in the DB.
    $persistenceId = $logicLayer->createStudent(
        $firstName,
        $lastName,
        $userName,
        $password_hash,
        $emailAddress,
        $studentId,
        $address,
        $major
    );


    header("Location: ../login.php?status=Success");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../register.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../register.php?status={$errorMsg}");
}
exit();