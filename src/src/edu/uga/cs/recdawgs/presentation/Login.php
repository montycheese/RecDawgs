<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/20/16
 * Time: 10:33
 */

namespace edu\uga\cs\recdawgs\presentation;
require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl as Logic;


for($i=0; $i<count($_POST); $i++){
    if(!isset($_POST)){
        //redirect
    }
}

$userName = $_POST['userName'];
$password = $_POST['password'];
//hash password

//do authentication

$logicLayer = new Logic\LogicLayerImpl();





