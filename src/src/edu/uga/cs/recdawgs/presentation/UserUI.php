<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:45
 */

namespace edu\uga\cs\recdawgs\presentation;

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

class UserUI {

    private $logicLayer = null;

    public function __construct(){
        $this->logicLayer = new LogicLayerImpl\LogicLayerImpl();
    }

    public function create(){

    }

}