<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 16:23
 */


require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();

if ($_POST['teamname'] == "" or $_POST['teamname'] == null) {
    $errorMsg = urlencode("Missing form field");
    header("Location: ../updateTeam.php?status={$errorMsg}");
    exit();
}

if (intval($_POST['userid']) == -1 or intval($_POST['leagueid']) == -1) {
    $errorMsg = urlencode("Missing form field");
    header("Location: ../updateTeam.php?status={$errorMsg}");
    exit();
}

try {

    $team = $logicLayer->findTeam(null, $_POST['teamID'])->current();
    $student = $logicLayer->findStudent(null, intval($_POST['userid']))->current();
    $league = $logicLayer->findLeague(null, intval($_POST['leagueid']))->current();

    $logicLayer->updateTeam($team->getName(), 
        $_POST['teamname'], 
        $student, 
        $league, 
        null);

    $successMsg = urlencode("Team successfully updated!");
    header("Location: ../updateTeam.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../updateTeam.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../updateTeam.php?status={$errorMsg}");
}
exit();