<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/28/16
 * Time: 22:05
 */

session_start();
require_once('autoload.php');
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();


//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../sportsVenues.php?status={$errorMsg}");
        exit();
    }
}
try {

    $leagueId = intval(trim($_POST['leagueId']));
    $sportsVenueId = intval(trim($_POST['sportsVenueId']));

    $logicLayer->createLeagueSportsVenue($leagueId, $sportsVenueId);
    $msg = urlencode("Sports venue assigned to league successfully");
    header("Location: ../sportsVenues.php?status={$msg}");
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../sportsVenues.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    echo $e->getTraceAsString();
    header("Location: ../sportsVenues.php?status={$errorMsg}");
}
exit();