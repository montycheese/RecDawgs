<?php

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$leagueId = $_POST['leagueId'];

try {
    // find league
    $league = $logicLayer->findLeague(null, $leagueId)->current();

    // delete user
    $logicLayer->deleteLeague($league);

    $successMsg = urlencode("League successfully deleted!");
    header("Location: ../league.php");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../league.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../league.php?status={$errorMsg}");
}
exit();