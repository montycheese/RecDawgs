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
$sportsVenueId = $_POST['sportsVenueId'];
$newVenueName = null;
$venueType = null;
$address = null;

try {
    // updated information
    if (trim($_POST['venueName']) == "" or $_POST['venueName'] == null) {
        $newVenueName = null;
    } else {
        $newVenueName = trim($_POST['venueName']);
    }
    if (intval($_POST['isIndoor']) != -1) {
    	$venueType = intval($_POST['isIndoor']);
    }
    if (trim($_POST['address']) != "" and $_POST['address'] != null) {
        $address = trim($_POST['address']);
    }

    // udpate team
    $logicLayer->updateSportsVenue(
    	$sportsVenueId, $newVenueName, $venueType, $address);

    $successMsg = urlencode("Sports venue successfully updated!");
    header("Location: ../sportsVenues.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../sportsVenues.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../sportsVenues.php?status={$errorMsg}");
}
exit();