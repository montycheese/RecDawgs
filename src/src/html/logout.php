<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/22/16
 * Time: 14:07
 */

//check if user is even logged in
if(isset($_SESSION) && isset($_SESSION['userObject'])) {

    //unset all session variables.
    for ($i = 0; $i < count($_SESSION); $i++) {
        unset($_SESSION[$i]);
    }
    //destroy the php session.
    session_destroy();
}
//redirect to login page.
header("Location: login.php");