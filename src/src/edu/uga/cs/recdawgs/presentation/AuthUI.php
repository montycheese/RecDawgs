<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/22/16
 * Time: 14:15
 */

namespace edu\uga\cs\recdawgs\presentation;

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\persistence\impl\PersistenceLayerImpl as PersistenceLayerImpl;
class AuthUI {

    private $dbConnection, $objectLayer, $persistenceLayer, $logicLayer;

    /**
     * @param \edu\uga\cs\recdawgs\persistence\impl\DbConnection $dbConnection
     */
    public function __construct($dbConnection=null){
        if($dbConnection==null){
            $dbConnection = new \edu\uga\cs\recdawgs\persistence\impl\DbConnection();
        }
        $objectLayer = new ObjectLayerImpl(null);
        $persistenceLayer = new PersistenceLayerImpl($dbConnection, $objectLayer);
        $objectLayer->setPersistence($persistenceLayer);
        $logicLayer = new LogicLayerImpl($objectLayer, $dbConnection);

        //store in Auth UI obj. dont add to session until user has been authenticated.
        $this->dbConnection = $dbConnection;
        $this->objectLayer = $objectLayer;
        $this->persistenceLayer = $persistenceLayer;
        $this->logicLayer = $logicLayer;
    }

    /**
     *
     *
     * @param String $username
     * @param String $password
     * @return string
     */
    public function validateLogin($username, $password){
        //try student
        $modelStudent = $this->objectLayer->createStudent();

        //$password_hash = password_hash($password, PASSWORD_DEFAULT); this code is used to hash the password into DB. when we register a user.

        $modelStudent->setUserName($username);
        //$student->setPassword($password);
        //only set username, get password then apply password hash function
        $studentIter = $this->logicLayer->findStudent($modelStudent);
        if($studentIter->size() == 1){
            //get student
            $student = $studentIter->current();
            //compare entered password and hashed one in db
            if(password_verify($password, $student->getPassword())){
                return $this->createSession($student, true);
            }
            else{
                return "Incorrect password.";
            }
        }

        //try admin
        $modelAdmin = $this->objectLayer->createAdministrator();

        $modelAdmin->setUserName($username);
        //only set username, get password then apply password hash function
        $adminIter = $this->logicLayer->findAdmin($modelAdmin);
        if($adminIter->size() == 1){
            //get student
            $admin = $adminIter->current();
            //compare entered password and hashed one in db
            if(password_verify($password, $admin->getPassword())){
                return $this->createSession($admin, false);
            }
            else{
                return "Incorrect password.";
            }
        }
        else{
            //at this point the username was not found for student nor admin.
            return "Username not found.";
        }


    }

    /**
     * Create a session and store information in cookies.
     *
     * @param User $user
     * @param bool $student true if this is a student object. False if it is an adin
     * @return string, session create success.
     */
    private function createSession($user, $student=true){
        session_start();
        $_SESSION['userObject'] = $user;
        $_SESSION['logicLayer'] = $this->logicLayer;
        $_SESSION['objectLayer'] = $this->objectLayer;
        $_SESSION['persistenceLayer'] = $this->persistenceLayer;
        $_SESSION['dbConnection'] = $this->dbConnection;
        if($student){
            $_SESSION['userType'] = 0;
        }
        else{
            //admin
            $_SESSION['userType'] = 1;
        }
        return "Login created, session started.";
    }
}