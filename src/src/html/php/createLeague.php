<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 16:57
 */

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../leagues.php?status={$errorMsg}");
        exit();
    }
}


try {

    $persistenceId = $_SESSION['logicLayer']->createLeague(
        trim($_POST['name']),
        trim($_POST['leagueRules']),
        trim($_POST['matchRules']),
        trim($_POST['isIndoor']),
        intval(trim($_POST['minTeams'])),
        intval(trim($_POST['maxTeams'])),
        intval(trim($_POST['minMembers'])),
        intval(trim($_POST['maxMembers']))
    );

    $successMsg = urlencode("League successfully created!");
    header("Location: ../leagues.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../leagues.php?status={$error_msg}");
}
catch(Exception $e){
    header("Location: ../leagues.php?status={urlencode(Unexpected error)}");
}
exit();