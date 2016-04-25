<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:45
 */

namespace edu\uga\cs\recdawgs\presentation;

require_once("autoload.php");

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;

class UserUI {

    private $logicLayer = null;

    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    public function create(){

    }

    public function listUserInformation($userId, $userType){

        $html = "";
        if($userType == 0){
            $studentIter = $this->logicLayer->findStudent(null, $userId);
            if($studentIter != null){
                while($studentIter->valid()){
                    $student = $studentIter->current();
                    $html .= "";
                }
            }
        }
        else if($userType == 1){
            $adminIter = $this->logicLayer->findAdmin(null, $userId);
            if($adminIter){

            }
        }
        return $html;

    }

}