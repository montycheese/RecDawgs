<?php
/**
 * Created by PhpStorm.
 * User: skhan731
 * Date: 4/29/2016
 * Time: 3:15 PM
 */

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$matchId = $_POST['matchId'];

try {
    // find match
    $match = $logicLayer->findMatch(null, $matchId);
    $logicLayer->resolveMatchScore($_POST['homeTeamScore'], $_POST['awayTeamScore'], $match);

    $successMsg = urlencode("Match score successfully resolved!");
    header("Location: ../resolveMatchScore.php");
    
} catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../resolveMatchScore.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../resolveMatchScore.php?status={$errorMsg}");
}
exit();