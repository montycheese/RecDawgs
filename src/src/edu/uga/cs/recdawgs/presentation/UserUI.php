<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:45
 */

namespace edu\uga\cs\recdawgs\presentation;


class UserUI {

    private $logicLayer = null;

    public function __construct(){
        $this->logicLayer = $_SESSION['logicLayer'];
    }

    public function create(){

    }

}