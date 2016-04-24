<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 16:23
 */

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../teams.php?status={$errorMsg}");
        exit();
    }
}


try {
    $logicLayer = $_SESSION['logicLayer'];
    //store the team in the DB.
    //league id will be hidden on the form
    //create a league model to get league obj.
    $leagueModel = $_SESSION['objectLayer']->createLeague();
    $leagueModel->setId($_POST['leagueId']);
    $league = $_SESSION['logicLayer']->findLeague($leagueModel)->current();

    $persistenceId = $logicLayer->createTeam(
        trim($_POST['teamName']),
        $_SESSION['userObject'],
        $league
    );

    $successMsg = urlencode("Team successfully created!");
    header("Location: ../teams.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../teams.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg = urlencode("Unexpected error");
    header("Location: ../teams.php?status={$errorMsg}");
}
exit();