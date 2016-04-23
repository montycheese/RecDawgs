<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 17:22
 */

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        //todo figure out where im rerouting traffic
        //header("Location: ../teams.php?status=failure");
        exit();
    }
}


try {
    $logicLayer = $_SESSION['logicLayer'];

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
    $error_msg = urlencode($rde->string);
    //header("Location: ../teams.php?status={$error_msg}");
}
catch(Exception $e){
    //header("Location: ../teams.php?status={urlencode(Unexpected error)}");
}
exit();