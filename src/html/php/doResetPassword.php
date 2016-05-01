<?php

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

session_start();

$logicLayer = new LogicLayerImpl();
$userID = intval($_POST['userId']);
$admin = null;
$student = null;

try {
    // find admin or student
    if($_SESSION['userType'] == 1) {
        $admin = $logicLayer->findAdmin(null, $userID);
    } else {
    	$student = $logicLayer->findStudent(null, $userID);
    }

    // reset password
    $logicLayer->resetPassword($student, $admin);

    $successMsg = urlencode("Password successfully reset!");
    header("Location: ../profile.php?status={$successMsg}");
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../profile.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../profile.php?status={$errorMsg}");
}
exit(); 