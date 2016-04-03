<?php

//namespace

/** This class represents information about a registered student of in the RecDawgs system.
 * A student is a user who, additionally, has a student id, major, and an address.
 *
 */

  public interface Student extends User
  {
    /** Return the student id for this student.
     * @return the String representing the id of the student
     */
     public function getStudentId();
     
    /** Set the new student id for this student.
     * @param studentId the new student id of this student
     */
     public function setStudentId($studentId);
     
    /** Return the major of this student.
     * @return the major of this student
     */
     public function getMajor();
     
     /** Set the new major of this student.
     * @param major the new major of this student
     */
    public function setMajor($major);
    
    /** Return the address of this student.
     * @return the address of this student
     */
    public function getAddress();
    
    /** Set the new address for this student.
     * @param address the new address of this student
     */
    public function setAddress($address);
  }

?>
