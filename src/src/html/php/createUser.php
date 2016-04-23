<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:56
 */
//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        header("Location: ../register.php?status=failure");
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
    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $logicLayer = $_SESSION['logicLayer'];
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

    header("Location: ../register.php?status=Success}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../register.php?status={$error_msg}");
}
catch(Exception $e){
    header("Location: ../register.php?status={urlencode(Unexpected error)}");
}
exit();