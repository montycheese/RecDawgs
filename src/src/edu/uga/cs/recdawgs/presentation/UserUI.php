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
            if($studentIter != null && $studentIter->valid()){
                $student = $studentIter->current();
                $html .= "First Name: " . $student->getFirstName() . "<br/>";
                $html .= "Last Name: " . $student->getLastName() . "<br/>";
                $html .= "User Name: " . $student->getUserName() . "<br/>";
                $html .= "Email: " . $student->getEmailAddress() . "<br/>";
                $html .= "Student ID: " . $student->getStudentId() . "<br/>";
                $html .= "Address: " . $student->getAddress() . "<br/>";
                $html .= "Major: " . $student->getMajor() . "<br/>";

            }

        }
        else if($userType == 1){
            $adminIter = $this->logicLayer->findAdmin(null, $userId);
            if($adminIter != null && $adminIter->valid()){
                if($adminIter != null && $adminIter->valid()){
                    $admin = $adminIter->current();
                    $html .= "First Name: " . $admin->getFirstName() . "<br/>";
                    $html .= "Last Name: " . $admin->getLastName() . "<br/>";
                    $html .= "User Name: " . $admin->getUserName() . "<br/>";
                    $html .= "Email: " . $admin->getEmailAddress() . "<br/>";

                }
            }
        }
        return $html;

    }

}