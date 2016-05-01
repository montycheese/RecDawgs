<?php
/**
 * Created by PhpStorm.
 * User: mwong
 * Date: 4/28/16
 * Time: 1:04 PM
 */

session_start();
require_once('autoload.php');
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl();

try {
    //return all leagues that dont meet the requirements.

    $unsatisfiedLeagues = $logicLayer->closeEnrollment();
    $num = count($unsatisfiedLeagues);
    $msg = "Rounds generated and matches fixed. {$num} Leagues still not meeting requirements: ";
    for($i=0;$i<$num; $i++){
        $msg .= $unsatisfiedLeagues[$i]->getName() . ' ';
    }
    $msg = urlencode($msg);
    header("Location: ../leagues.php?status={$msg}");
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../leagues.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    echo $e->getTraceAsString();
    header("Location: ../leagues.php?status={$errorMsg}");
}
exit();