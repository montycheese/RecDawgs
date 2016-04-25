<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 17:22
 */

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl\LogicLayerImpl();

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        //todo figure out where im rerouting traffic
        $errorMsg = urlencode("Missing form field");
     //   header("Location: ../teams.php?status={$errorMsg}");

        exit();
    }
}


try {

    $matchModel = $_SESSION['objectLayer']->createMatch();
    $matchModel->setId(intval(trim($_POST['matchId'])));
    $match = $logicLayer->findMatch($matchModel)->current();

    //assuming only the team captains can enter scores
    $persistenceId = $logicLayer->enterMatchScore(
        $_SESSION['userObject'],
        $match,
        intval(trim($_POST['homeTeamScore'])),
        intval(trim($_POST['awayTeamScore'])));

    $successMsg = urlencode("Scores input successfully!");
    //header("Location: ../teams.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $errorMsg = urlencode($rde->string);
    //header("Location: ../teams.php?status={$errorMsg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    //header("Location: ../teams.php?status={$errorMsg}");
}
exit();