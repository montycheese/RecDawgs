<?php
namespace edu\uga\cs\recdawgs\entity\impl;

use edu\uga\cs\recdawgs\entity\User as User;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;

class UserImpl extends Persistent implements User{

    var $firstName;
    var $lastName;
    var $userName;
    var $password;
    var $emailAddress;

    /**
     * UserImpl constructor.
     * @param $firstName
     * @param $lastName
     * @param $userName
     * @param $password
     * @param $emailAddress
     */
    public function __construct($firstName, $lastName, $userName, $password, $emailAddress)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->password = $password;
        $this->emailAddress = $emailAddress;
    }

    /** Return the user's first name.
     * @return $this->firstName the user's first name
     */
    public function getFirstName(){
        return $this->firstName;
    }

    /** Set the user's first name.
     * @param $firstName the new first name of this user
     */
    public function setFirstName($firstName){
        $this->firstName = $firstName;
    }

    /** Return the user's last name.
     * @return $this->lastName the user's last name
     */
    public function getLastName(){
        return $this->lastName;
    }

    /** Set the user's first name.
     * @param $lastName the new last name of this user
     */
    public function setLastName($lastName){
        $this->lastName = $lastName;
    }

    /** Return the user's user name (login name).
     * @return $this->userName the user's user name
     */
    public function getUserName(){
        return $this->userName;
    }

    /** Set the user's user name (login name).
     * @param $userName the user's new username
     */
    public function setUserName($userName){
        $this->userName = $userName;
    }

    /** Return the user's password.
     * @return $this->password the user's password
     */
    public function getPassword(){
        return $this->password;
    }

    /** Set the user's password.
     * @param $password the user's new password
     */
    public function setPassword($password){
        $this->password = $password;
    }

    /** Return the user's email address.
     * @return $this->emailAddress
     */
    public function getEmailAddress(){
        return $this->emailAddress;
    }

    /** Set the user's email address.
     * @param $emailAddress the new email address
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}