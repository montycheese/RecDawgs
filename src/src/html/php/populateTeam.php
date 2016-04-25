<?php

//used to populate the teams that a given user is part of, in teams.php

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

$logicLayer = new LogicLayerImpl\LogicLayerImpl();

try {

    
    

} catch (\edu\uga\cs\recdawgs\RDException $rde){
    $error_msg = urlencode($rde->string);
    //header("Location: ../teams.php?status={$error_msg}");
}
catch(Exception $e){
    //header("Location: ../teams.php?status={urlencode(Unexpected error)}");
}

exit();