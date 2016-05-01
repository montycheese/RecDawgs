<?php

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\entity\impl as Entity;

$logicLayer = new LogicLayerImpl();
$userName = trim($_POST['userName']);

try {
    // find admin or student
    $adminModel = new Entity\AdministratorImpl();
    $adminModel->setUserName($userName);
    $admin = $logicLayer->findAdmin($adminModel, -1)->current();

    $studentModel = new Entity\StudentImpl();
    $studentModel->setUserName($userName);
    $student = $logicLayer->findStudent($studentModel, -1)->current();

    // reset password
    $logicLayer->resetPassword($student, $admin);

    $successMsg = urlencode("Password successfully reset!");
    header("Location: ../login.php?status={$successMsg}");
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../login.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../login.php?status={$errorMsg}");
}
exit(); 