<?php 

//check to make sure none of the data is null or empty
foreach($_POST as $inputData){
    if($inputData == "" or $inputData == null){
        $errorMsg = urlencode("Missing form field");
        header("Location: ../createSportsVenue.php?status={$errorMsg}");
        exit();
    }
}


try {

    $persistenceId = $_SESSION['logicLayer']->createSportsVenue(
        trim($_POST['venueName']),
        trim($_POST['isIndoor']),
        trim($_POST['address'])
    );

    $successMsg = urlencode("Sports venue successfully created!");
    header("Location: ../createSportsVenue.php?status={$successMsg}");
    //echo $persistenceId;
}
catch(\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    header("Location: ../createSportsVenue.php?status={$error_msg}");
}
catch(Exception $e){
    $errorMsg= urlencode("Unexpected error");
    header("Location: ../createSportsVenue.php?status={$errorMsg}");
}
exit();