<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 17:22
 */
session_start();
require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
       header("Location: ../enterMatchScore.php?status={$errorMsg}");
        exit();
    }
}


try {

    $match = $logicLayer->findMatch(null, $_POST['matchId'])->current();
    $teamCaptain = $logicLayer->findStudent(null, $_SESSION['userId'])->current();
    //assuming only the team captains can enter scores
    $persistenceId = $logicLayer->enterMatchScore(
        $teamCaptain,
        $match,
        intval(trim($_POST['homeTeamScore'])),
        intval(trim($_POST['awayTeamScore'])));

    $successMsg = urlencode("Scores input successfully!");
    header("Location: ../match.php?status={$successMsg}");
    echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $errorMsg = urlencode($rde->string);
    header("Location: ../match.php?status={$errorMsg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../match.php?status={$errorMsg}");
}
exit();