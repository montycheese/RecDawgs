<?php
namespace edu\uga\cs\recdawgs\entity;

use edu\uga\cs\recdawgs\persistence\Persistable as Persistable;
//use edu\uga\cs\recdawgs\RDException as RDException;


/** This is the base class of all registered users of the RecDawgs system.
 * Each user has a first and last name, a user name (i.e., a login name), password, and an email address.
 * The login name must be unique.
 *
 */
interface User
    extends Persistable
{
    /** Return the user's first name.
     * @return the user's first name
     */
    public function getFirstName();
    
    /** Set the user's first name.
     * @param firstName the new first name of this user
     */
    public function setFirstName($firstName);
    
    /** Return the user's last name.
     * @return the user's last name
     */
    public function getLastName();
    
    /** Set the user's first name.
     * @param lastName the new last name of this user
     */
    public function setLastName($lastName);
    
    /** Return the user's user name (login name).
     * @return the user's user name (login name)
     */
    public function getUserName();
    
    /** Set the user's user name (login name).
     * @param userName the new user (login name)
     */
    public function setUserName($userName);
    
    /** Return the user's password.
     * @return the user's password
     */
    public function getPassword();
    
    /** Set the user's password.
     * @param password the new password
     */
    public function setPassword($password);
    
    /** Return the user's email address.
     * @return the user's email address
     */
    public function getEmailAddress();
    
    /** Set the user's email address.
     * @param emailAddress the new email address
     */
    public function setEmailAddress($emailAddress);

}

?>
