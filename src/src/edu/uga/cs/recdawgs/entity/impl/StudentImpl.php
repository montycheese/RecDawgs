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

    var $studentId;
    var $major;
    var $address;

    /**
     * StudentImpl constructor.
     * @param $studentId
     * @param $major
     * @param $address
     */
    public function __construct($studentId, $major, $address)
    {
        $this->studentId = $studentId;
        $this->major = $major;
        $this->address = $address;
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