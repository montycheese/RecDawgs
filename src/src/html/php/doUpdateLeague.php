<?php
/**
 * Created by PhpStorm.
 * User: skhan731
 * Date: 4/27/16
 * Time: 08:56
 */

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$newName = null;
$newLeagueRules = null;
$newMatchRules = null;
$newIsIndoor = null;
$newMinTeams = null;
$newMaxTeams = null;
$newMinMembers = null;
$newMaxMembers = null;
$newWinner = null;
$league = null;

try {
    if (intval($_POST['leagueId']) != -1){
        $league = $logicLayer->findLeague(null, intval($_POST['leagueId']))->current();        
    }
    if (trim($_POST['leagueName']) == "" or $_POST['leagueName'] == null) {
        $newName = null;
    } else {
        $newName = trim($_POST['leagueName']);
    }
    if (trim($_POST['leagueRules']) == "" or $_POST['leagueRules'] == null) {
        $newLeagueRules = null;
    } else {
        $newLeagueRules = trim($_POST['leagueRules']);
    }
    if (trim($_POST['matchRules']) == "" or $_POST['matchRules'] == null) {
        $newMatchRules = null;
    } else {
        $newMatchRules = trim($_POST['matchRules']);
    }
    if (trim($_POST['isIndoor']) == "" or $_POST['isIndoor'] == null) {
        $newIsIndoor = null;
    } else {
        $newIsIndoor = trim($_POST['isIndoor']);
    }
    if (trim($_POST['minTeams']) == "" or $_POST['minTeams'] == null) {
        $newMinTeams = null;
    } else {
        $newMinTeams = trim($_POST['minTeams']);
    }
    if (trim($_POST['maxTeams']) == "" or $_POST['maxTeams'] == null) {
        $newMaxTeams = null;
    } else {
        $newMaxTeams = trim($_POST['maxTeams']);
    }
    if (trim($_POST['minMembers']) == "" or $_POST['minMembers'] == null) {
        $newMinMembers = null;
    } else {
        $newMinMembers = trim($_POST['minMembers']);
    }
    if (trim($_POST['maxMembers']) == "" or $_POST['maxMembers'] == null) {
        $newMaxMembers = null;
    } else {
        $newMaxMembers = trim($_POST['maxMembers']);
    }
    if (trim($_POST['winner']) == "" or $_POST['winner'] == null) {
        $newWinner = null;
    } else {
        $newWinner = trim($_POST['winner']);
    }

    $logicLayer->updateLeague($league->getName(),
        $newLeagueName,
        $newLeagueRules,
        $newMatchRules,
        $newIsIndoor,
        $newMinTeams,
        $newMaxTeams,
        $newMinMembers,
        $newMaxMembers,
        $newWinner);
    
    $successMsg = urlencode("League successfully updated!");
    header("Location: ../league.php?status={$successMsg}");
    
} catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../league.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../league.php?status={$errorMsg}");
}
exit();