<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/24/16
 * Time: 15:54
 */

use edu\uga\cs\recdawgs\presentation\AuthUI as AuthUI;

try {
    $authUI = new AuthUI();
    $message = $authUI->validateLogin($_POST['userName'], $_POST['password']);
    if($message !=  "Login created, session started"){
        $message = urlencode($message);
        header("Location: ../login.php?=status={$message}");
    }
    else {
        $message = urlencode($message);
        header("Location: ../index.php?=status={$message}");
    }
}
catch(Exception $e){
    $message = urlencode("Unexpected Error during authentication");
    header("Location: ../login.php?=status={$message}");
}
exit();
