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
$newTeamName = null;
$student = null;
$league = null;

try {
    // updated information
    if (trim($_POST['teamname']) == "" or $_POST['teamname'] == null) {
        $newTeamName = null;
    } else {
        $newTeamName = trim($_POST['teamname']);
    }
    if (intval($_POST['userid']) != -1) {
        $student = $logicLayer->findStudent(null, intval($_POST['userid']))->current();
    }
    if (intval($_POST['leagueid']) != -1) {
        $league = $logicLayer->findLeague(null, intval($_POST['leagueid']))->current();
    }

    // find team
    $team = $logicLayer->findTeam(null, $_POST['teamID'])->current();

    // udpate team
    $logicLayer->updateTeam($team->getName(), 
        $newTeamName, 
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