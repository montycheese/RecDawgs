<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 16:23
 */

session_start();
require_once('autoload.php');
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../teams.php?status={$errorMsg}");
        exit();
    }
}


try {
    //store the team in the DB.
    //league id will be hidden on the form
    //create a league model to get league obj.
    //$leagueModel = $logicLayer->createLeague();
    //$leagueModel->setId($_POST['leagueId']);
    $league = $logicLayer->findLeague(null, intval($_POST['leagueId']))->current();
    $teamCaptain = $logicLayer->findStudent(null, intval($_SESSION['userId']))->current();
    $persistenceId = $logicLayer->createTeam(
        trim($_POST['teamName']),
        $teamCaptain,
        $league
    );

    $successMsg = urlencode("Team: {$_POST['teamName']} successfully created!");
    header("Location: ../teams.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../teams.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../teams.php?status={$errorMsg}");
}
exit();