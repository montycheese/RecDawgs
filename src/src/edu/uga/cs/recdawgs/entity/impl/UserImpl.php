<?php
namespace edu\uga\cs\recdawgs\entity\impl;


use edu\uga\cs\recdawgs\entity\User as User;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;

class UserImpl extends Persistent implements User {
    private $firstName = null;
    private $email = null;
    //TODO add rest

    /**
     * UserImpl constructor.
     * @param $name
     * @param $email
     * @param etc....
     */
    public function __construct($firstName=null, $email=null) {
        //TODO
        //NOTE, for all constructors, make every parameter in the method signature = null
        // e.g. what I wrote above
    }


    /** Return the user's first name.
     * @return the user's first name
     */
    public function getFirstName() {
        // TODO: Implement getFirstName() method.
    }

    /** Set the user's first name.
     * @param firstName the new first name of this user
     */
    public function setFirstName($firstName) {
        // TODO: Implement setFirstName() method.
    }

    /** Return the user's last name.
     * @return the user's last name
     */
    public function getLastName() {
        // TODO: Implement getLastName() method.
    }

    /** Set the user's first name.
     * @param lastName the new last name of this user
     */
    public function setLastName($lastName) {
        // TODO: Implement setLastName() method.
    }

    /** Return the user's user name (login name).
     * @return the user's user name (login name)
     */
    public function getUserName() {
        // TODO: Implement getUserName() method.
    }

    /** Set the user's user name (login name).
     * @param userName the new user (login name)
     */
    public function setUserName($userName) {
        // TODO: Implement setUserName() method.
    }

    /** Return the user's password.
     * @return the user's password
     */
    public function getPassword() {
        // TODO: Implement getPassword() method.
    }

    /** Set the user's password.
     * @param password the new password
     */
    public function setPassword($password) {
        // TODO: Implement setPassword() method.
    }

    /** Return the user's email address.
     * @return the user's email address
     */
    public function getEmailAddress() {
        // TODO: Implement getEmailAddress() method.
    }

    /** Set the user's email address.
     * @param emailAddress the new email address
     */
    public function setEmailAddress($emailAddress) {
        // TODO: Implement setEmailAddress() method.
    }
}