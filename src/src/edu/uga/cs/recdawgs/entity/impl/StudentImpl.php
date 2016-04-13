<?php

namespace edu\uga\cs\recdawgs\entity\impl;

use edu\uga\cs\recdawgs\entity\Student as Student;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents information about a registered student of in the RecDawgs system.
 * A student is a user who, additionally, has a student id, major, and an address.
 *
 */

class StudentImpl extends Persistent implements Student {

    private $firstName;
    private $lastName;
    private $userName;
    private $password;
    private $emailAddress;
    private $studentId;
    private $major;
    private $address;

    /**
     * StudentImpl constructor.
     * @param $firstName
     * @param $lastName
     * @param $userName
     * @param $password
     * @param $emailAddress
     * @param $studentId
     * @param $major
     * @param $address
     */
    public function __construct($firstName=null, $lastName=null, $userName=null, $password=null, $emailAddress=null,$studentId=null, $major=null, $address=null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->userName = $userName;
        $this->password = $password;
        $this->emailAddress = $emailAddress;
        $this->studentId = $studentId;
        $this->major = $major;
        $this->address = $address;
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

    /** Return the student id for this student.
     * @return $this->studentId
     */
    public function getStudentId(){
        return $this->studentId;
    }

    /** Set the new student id for this student.
     * @param $studentId
     */
    public function setStudentId($studentId){
        $this->studentId = $studentId;
    }

    /** Return the major of this student.
     * @return $this->major
     */
    public function getMajor(){
        return $this->major;
    }

    /** Set the new major of this student.
     * @param $major
     */
    public function setMajor($major){
        $this->major = $major;
    }

    /** Return the address of this student.
     * @return $this->address
     */
    public function getAddress(){
        return $this->address;
    }

    /** Set the new address for this student.
     * @param $address
     */
    public function setAddress($address){
        $this->address = $address;
    }

}