<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/22/16
 * Time: 14:07
 */

//check if user is even logged in

session_start();
    //destroy the php session.
session_unset();
session_destroy();

//redirect to login page.
header("Location: login.php");