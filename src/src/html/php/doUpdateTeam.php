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
    if (trim($_POST['teamName']) == "" or $_POST['teamName'] == null) {
        $newTeamName = null;
    } else {
        $newTeamName = trim($_POST['teamName']);
    }
    if (intval($_SESSION['userId']) != -1) {
        $student = $logicLayer->findStudent(null, intval($_SESSION['userId']))->current();
    }
    if (intval($_POST['leagueId']) != -1) {
        $league = $logicLayer->findLeague(null, intval($_POST['leagueId']))->current();
    }

    // find team
    $team = $logicLayer->findTeam(null, $_POST['teamId'])->current();

    // udpate team
    $logicLayer->updateTeam($team->getName(), 
        $newTeamName, 
        $student, 
        $league, 
        null);

    $successMsg = urlencode("Team name successfully updated to {$newTeamName}!");
    header("Location: ../team.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../team.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../team.php?status={$errorMsg}");
}
exit();