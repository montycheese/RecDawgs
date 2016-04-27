<?php

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$userId = $_POST['userId'];

try {
    // find user
    $user = $logicLayer->findStudent(null, $userId)->current();

    // delete user
    $logicLayer->deleteUser($user);

    $successMsg = urlencode("User successfully deleted!");
    header("Location: ../logout.php");
    //echo $persistenceId;
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