<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 5/1/16
 * Time: 12:45
 */

session_start();
require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../index.php?status={$errorMsg}");
        exit();
    }
}


try {
    $user = null;
    if($_SESSION['userType'] == 0){
        $user = $logicLayer->findStudent(null, $_SESSION['userId'])->current();
    }
    else{
        $user = $logicLayer->findAdmin(null, $_SESSION['userId'])->current();
    }
    $match = $logicLayer->findMatch(null, $_POST['matchId'])->current();
    $match->setDate($_POST['date']);

    $logicLayer->objectLayer->storeMatch($match);

    $successMsg = urlencode("Match scheduled successfully!");
    header("Location: ../index.php?status={$successMsg}");
    echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $errorMsg = urlencode($rde->string);
    header("Location: ../index.php?status={$errorMsg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../index.php?status={$errorMsg}");
}
exit();