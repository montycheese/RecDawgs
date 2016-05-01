<?php

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$teamId = $_POST['teamId'];

try {
    // find team
    $team = $logicLayer->findTeam(null, $teamId)->current();

    // delete team
    $logicLayer->deleteTeam($team);

    $successMsg = urlencode("Team successfully deleted!");
    header("Location: ../teams.php");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    die($error_msg);
    header("Location: ../team.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    die($errorMsg);
    header("Location: ../team.php?status={$errorMsg}");
}
exit();