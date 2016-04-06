<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 12:44
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class UserManager {

    private $dbConnection = null;
    private $objLayer = null;

    /**
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }

    /**
     * Saves an admin obj to database or updates if it already exists
     *
     * @param Entity\UserImpl $administrator
     * @throws RDException
     */
    public function saveAdministrator($administrator){
        if($administrator->isPersistent()){
            //update
            $q = "UPDATE " . DB_NAME . ".user" .
              "set first_name = ?,
              last_name = ?,
              user_name = ?,
              password = ?,
              email_address = ?
              WHERE user_id = ?;";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $administrator->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $administrator->getLastName(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $administrator->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $administrator->getPassword(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $administrator->getEmailAddress(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $administrator->getId(), \PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo 'Administrator updated successfully';
            } else {
                throw new RDException('Error updating Administrator');
            }
        }
        else {
            //doesn't exist in DB
            //create Query
            $q = "INSERT INTO team10.user (first_name, last_name, user_name, password, email_address, user_type)
              VALUES(?, ?, ?, ?, ?, 1)
              ON DUPLICATE KEY UPDATE
              first_name = VALUES(first_name),
              last_name = VALUES(last_name),
              user_name = VALUES(user_name),
              password = VALUES(password),
              email_address = VALUES(email_address);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $administrator->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $administrator->getLastName(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $administrator->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $administrator->getPassword(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $administrator->getEmailAddress(), \PDO::PARAM_STR);
            if ($stmt->execute()) {
                //set the persistence id of this obj
                $administrator->setId($this->dbConnection->lastInsertId());
                echo 'Administrator created successfully';
            } else {
                throw new RDException('Error creating Administrator');
            }
        }
    }

    /**
     * @param Entity\StudentImpl $student
     * @throws RDException
     */
    public function saveStudent($student){
        if($student->isPersistent()){
            //update
            $q = "UPDATE " . DB_NAME . ".user" .
                "set first_name = ?,
              last_name = ?,
              user_name = ?,
              password = ?,
              email_address = ?,
              student_id = ?,
              address = ?,
              major = ?
              WHERE user_id = ?;";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $student->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $student->getLastName(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $student->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $student->getPassword(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $student->getEmailAddress(), \PDO::PARAM_STR);
            $stmt->bindParam(6, $student->getStudentId(), \PDO::PARAM_STR);
            $stmt->bindParam(7, $student->getAddress(), \PDO::PARAM_STR);
            $stmt->bindParam(8, $student->getMajor(), \PDO::PARAM_STR);
            $stmt->bindParam(9, $student->getId(), \PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo 'student updated successfully';
            } else {
                throw new RDException('Error updating student');
            }
        }
        else {
            //create Query
            $q = "INSERT INTO team10.user (first_name, last_name, user_name, password, email_address, student_id, address, major, user_type)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, 0)
              ON DUPLICATE KEY UPDATE
              first_name = VALUES(first_name),
              last_name = VALUES(last_name),
              user_name = VALUES(user_name),
              password = VALUES(password),
              email_address = VALUES(email_address),
              student_id=VALUES(student_id),
              address = VALUES(address),
              major= VALUES(major);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $student->getFirstName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $student->getLastName(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $student->getUserName(), \PDO::PARAM_STR);
            $stmt->bindParam(4, $student->getPassword(), \PDO::PARAM_STR);
            $stmt->bindParam(5, $student->getEmailAddress(), \PDO::PARAM_STR);
            $stmt->bindParam(6, $student->getStudentId(), \PDO::PARAM_STR);
            $stmt->bindParam(7, $student->getAddress(), \PDO::PARAM_STR);
            $stmt->bindParam(8, $student->getMajor(), \PDO::PARAM_STR);
            if ($stmt->execute()) {
                $student->setId($this->dbConnection->lastInsertId());
                echo 'Administrator created successfully';
            } else {
                throw new RDException('Error creating or updating Administrator');
            }
        }
    }

    /**
     * @param Entity\UserImpl $modelAdministrator
     * @return AdministratorIterator
     * @throws RDException
     */
    public function restoreAdministrator($modelAdministrator){
        $q = 'SELECT * from ' . DB_NAME. '.user WHERE 1=1 ;';
        if($modelAdministrator != NULL) {
            if ($attr = $modelAdministrator->getFirstName() != NULL) {
                $q .= ' AND first_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getLastName() != NULL) {
                $q .= ' AND last_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getUserName() != NULL) {
                $q .= ' AND user_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getPassword() != NULL) {
                $q .= ' AND password = ' . $attr;
            }
            if ($attr = $modelAdministrator->getEmailAddress() != NULL) {
                $q .= ' AND email_address = ' . $attr;
            }
            if ($attr = $modelAdministrator->getId() != NULL){
                $q .= 'AND user_id = ' . $attr;
            }
        }
        $stmt = $this->dbConnection->prepare($q);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new AdministratorIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring administrator model');
        }
    }

    /**
     * @param Entity\StudentImpl $modelStudent
     * @return StudentIterator
     * @throws RDException
     */
    public function restoreStudent($modelStudent){
        $q = 'SELECT * from ' . DB_NAME. '.user WHERE 1=1 ;';
        if($modelStudent != NULL) {
            if ($attr = $modelStudent->getFirstName() != NULL) {
                $q .= ' AND first_name = ' . $attr;
            }
            if ($attr = $modelStudent->getLastName() != NULL) {
                $q .= ' AND last_name = ' . $attr;
            }
            if ($attr = $modelStudent->getUserName() != NULL) {
                $q .= ' AND user_name = ' . $attr;
            }
            if ($attr = $modelStudent->getPassword() != NULL) {
                $q .= ' AND password = ' . $attr;
            }
            if ($attr = $modelStudent->getEmailAddress() != NULL) {
                $q .= ' AND email_address = ' . $attr;
            }
            if ($attr = $modelStudent->getMajor() != NULL) {
                $q .= ' AND major = ' . $attr;
            }
            if ($attr = $modelStudent->getAddress() != NULL) {
                $q .= ' AND address = ' . $attr;
            }
            if ($attr = $modelStudent->getStudentId() != NULL) {
                $q .= ' AND student_id = ' . $attr;
            }
            if ($attr = $modelStudent->getId() != NULL){
                $q .= 'AND user_id = ' . $attr;
            }
        }
        $stmt = $this->dbConnection->prepare($q);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new StudentIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring student model');
        }
    }

    /**
     * Deletes an Admin or Student from db.
     *
     * @param Entity\UserImpl $user
     * @throws RDException
     */
    public function delete($user){
        if($user->getId() == -1){
            //if user isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM ' . DB_NAME . '.user WHERE user_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $user->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'User deleted successfully';
        }
        else{
            throw new RDException('Deletion of User successful');
        }
    }

}