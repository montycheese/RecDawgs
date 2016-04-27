<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/26/16
 * Time: 23:19
 */
session_start();
require_once('autoload.php');
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

    $team = $logicLayer->findTeam(null, $_POST['teamId'])->current();
    $logicLayer->joinTeam($team, null, null, $_SESSION['userId']);

    $teamName= $team->getName();
    $successMsg = urlencode("Team: {$teamName} successfully joined!");
    header("Location: ../index.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../index.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    echo $e->getTraceAsString();
    header("Location: ../index.php?status={$errorMsg}");
}
exit();