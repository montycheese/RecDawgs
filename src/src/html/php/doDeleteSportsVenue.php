<?php
/**
 * Created by PhpStorm.
 * User: skhan731
 * Date: 4/27/16
 * Time: 08:53
 */

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();
$sportsVenueId = $_POST['sportsVenueId'];

try {
    //find sports venue
    $sportsVenue = $logicLayer->findSportVenue(null, $sportsVenueId)->current();

    //delete sports venue
    $logicLayer->deleteSportsVenue($sportsVenue);

    $successMsg = urlencode("Sports Venue successfully deleted!");
    header("Location: ../sportsVenues.php");

}catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../sportsVenue.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../sportsVenue.php?status={$errorMsg}");
}
exit();