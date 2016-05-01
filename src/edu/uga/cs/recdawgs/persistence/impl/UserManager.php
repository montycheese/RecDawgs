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
     * Saves an admin obj to database or updates if it already exists.
     *
     * @param Entity\AdministratorImpl $administrator
     * @throws RDException
     */
    public function saveAdministrator($administrator){
        if($administrator->isPersistent()){
            //update
            $q = "UPDATE " . DB_NAME . ".user " .
              "set first_name = ?,
              last_name = ?,
              user_name = ?,
              password = ?,
              email_address = ?
              WHERE user_id = ?;";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $firstName = $administrator->getFirstName();
            $lastName = $administrator->getLastName();
            $userName = $administrator->getUserName();
            $password = $administrator->getPassword();
            $emailAddress = $administrator->getEmailAddress();
            $persistenceId = $administrator->getId();
            $stmt->bindParam(1, $firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2,$lastName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $password, \PDO::PARAM_STR);
            $stmt->bindParam(5, $emailAddress, \PDO::PARAM_STR);
            $stmt->bindParam(6, $persistenceId, \PDO::PARAM_STR);

            //echo $q;
            if ($stmt->execute()) {
                echo 'Administrator updated successfully';
            } else {
                throw new RDException('Error updating Administrator ' . print_r($stmt->errorInfo()));
            }
        }
        else {
            //doesn't exist in DB
            //create Query
            $q = "INSERT INTO team10.user (first_name, last_name, user_name, password, email_address, user_type)
              VALUES(?, ?, ?, ?, ?, 1);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $firstName = $administrator->getFirstName();
            $lastName = $administrator->getLastName();
            $userName = $administrator->getUserName();
            $password = $administrator->getPassword();
            $emailAddress = $administrator->getEmailAddress();
            $stmt->bindParam(1, $firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2,$lastName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $password, \PDO::PARAM_STR);
            $stmt->bindParam(5, $emailAddress, \PDO::PARAM_STR);
           
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
     * Saves student in database.
     *
     * @param Entity\StudentImpl $student
     * @throws RDException
     */
    public function saveStudent($student){
        //die(var_dump($student));
        if($student->isPersistent()){
            //update
            $q = "UPDATE " . DB_NAME . ".user " .
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
            //bind parameters to prepared statement
            $firstName = $student->getFirstName();
            $lastName = $student->getLastName();
            $userName = $student->getUserName();
            $password = $student->getPassword();
            $emailAddress = $student->getEmailAddress();
            $address = $student->getAddress();
            $major = $student->getMajor();
            $studentId = $student->getStudentId();
            $persistenceId = $student->getId();
            $stmt->bindParam(1, $firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2,$lastName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $password, \PDO::PARAM_STR);
            $stmt->bindParam(5, $emailAddress, \PDO::PARAM_STR);
            $stmt->bindParam(6, $studentId, \PDO::PARAM_STR);
            $stmt->bindParam(7, $address, \PDO::PARAM_STR);
            $stmt->bindParam(8, $major, \PDO::PARAM_STR);
            $stmt->bindParam(9, $persistenceId, \PDO::PARAM_STR);
            if ($stmt->execute()) {
                echo 'student updated successfully';
            } else {
                throw new RDException('Error updating student');
            }
        }
        else {
            //create Query
            $q = "INSERT INTO team10.user (first_name, last_name, user_name, password, email_address, student_id, address, major, user_type)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, 0);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $firstName = $student->getFirstName();
            $lastName = $student->getLastName();
            $userName = $student->getUserName();
            $password = $student->getPassword();
            $emailAddress = $student->getEmailAddress();
            $address = $student->getAddress();
            $major = $student->getMajor();
            $studentId = $student->getStudentId();
            $stmt->bindParam(1, $firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2,$lastName, \PDO::PARAM_STR);
            $stmt->bindParam(3, $userName, \PDO::PARAM_STR);
            $stmt->bindParam(4, $password, \PDO::PARAM_STR);
            $stmt->bindParam(5, $emailAddress, \PDO::PARAM_STR);
            $stmt->bindParam(6, $studentId, \PDO::PARAM_STR);
            $stmt->bindParam(7, $address, \PDO::PARAM_STR);
            $stmt->bindParam(8, $major, \PDO::PARAM_STR);
            if ($stmt->execute()) {
                $student->setId($this->dbConnection->lastInsertId());
                echo 'student created successfully';
            } else {
                throw new RDException('Error creating or updating Student ' . print_r($stmt->errorInfo()));
            }
        }
    }

    /**
     * Restores Administrator in database.
     *
     * @param Entity\AdministratorImpl $modelAdministrator
     * @return AdministratorIterator
     * @throws RDException
     */
    public function restoreAdministrator($modelAdministrator){
        $q = 'SELECT * from ' . DB_NAME. '.user WHERE user.user_type = 1';
        if($modelAdministrator != NULL) {
            if ($modelAdministrator->getFirstName() != NULL) {
                $q .= ' AND first_name = ' . $modelAdministrator->getFirstName();
            }
            if ($modelAdministrator->getLastName() != NULL) {
                $q .= ' AND last_name = ' . $modelAdministrator->getLastName();
            }
            if ($modelAdministrator->getUserName() != NULL) {
                $q .= ' AND user.user_name = "' . $modelAdministrator->getUserName() . '"';
            }
            if ($modelAdministrator->getPassword() != NULL) {
                $q .= ' AND password = ' . $modelAdministrator->getPassword();
            }
            if ($modelAdministrator->getEmailAddress() != NULL) {
                $q .= ' AND email_address = ' . $modelAdministrator->getEmailAddress() ;
            }
            if ($modelAdministrator->getId() != -1){
                $q .= ' AND user_id = ' . $modelAdministrator->getId();
            }
        }

        $stmt = $this->dbConnection->prepare($q . ';');

        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new AdministratorIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring administrator model error:' .  print_r($stmt->errorInfo()));
        }
    }

    private function wrap($str){
        return "'" . $str . "'";
    }

    /**
     * Restores student in database.
     *
     * @param Entity\StudentImpl $modelStudent
     * @return StudentIteratorc
     * @throws RDException
     */
    public function restoreStudent($modelStudent){
        $q = 'SELECT * from team10.user WHERE user.user_type = 0 ';
        if($modelStudent != null) {
            if ($modelStudent->getFirstName() != NULL) {
                $q .= ' AND first_name = ' . $this->wrap($modelStudent->getFirstName());
            }
            if ($modelStudent->getLastName() != NULL) {
                $q .= ' AND last_name = ' . $this->wrap($modelStudent->getLastName()) ;
            }
            if ($modelStudent->getUserName() != NULL) {
                $q .= ' AND user_name = ' . $this->wrap($modelStudent->getUserName() );
            }
            if ($modelStudent->getPassword() != NULL) {
                $q .= ' AND password = ' . $this->wrap($modelStudent->getPassword());
            }
            if ($modelStudent->getEmailAddress() != NULL) {
                $q .= ' AND email_address = ' . $this->wrap($modelStudent->getEmailAddress());
            }
            if ( $modelStudent->getMajor() != NULL) {
                $q .= ' AND major = ' . $this->wrap($modelStudent->getMajor());
            }
            if ($modelStudent->getAddress() != NULL) {
                $q .= ' AND address = ' . $this->wrap($modelStudent->getMajor());
            }
            if ($modelStudent->getStudentId() != NULL) {
                $q .= ' AND student_id = ' . $modelStudent->getStudentId();
            }
            if($modelStudent->getId() != -1){
                $q .= ' AND user_id = ' . $modelStudent->getId();
            }
        }

        //echo $q;
        $stmt = $this->dbConnection->prepare($q . ';');
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
     * Restores teams captained by specific student.
     *
     * @param $student
     * @return TeamIterator
     * @throws RDException
     */
    public function restoreTeamsCaptainedBy($student){
        $q = 'SELECT * FROM team WHERE captain_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $persistenceId = $student->getId();
        $stmt->bindParam(1, $persistenceId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new TeamIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring teams captained by this student');
        }
    }

    /**
     * Restores teams that the student has joined.
     * 
     * @param $student
     * @return TeamIterator
     * @throws RDException
     */
    public function restoreTeamsMemberOf($student){
        $q = 'SELECT team.team_id, team.name, team.captain_id FROM team
                INNER JOIN is_member_of
                ON team.team_id = is_member_of.team_id
                WHERE is_member_of.user_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $persistenceId = $student->getId();
        $stmt->bindParam(1, $persistenceId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new TeamIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring teams joined by this student');
        }
    }

    /**
     * Deletes an Admin or Student from db.
     *
     * @param Entity\AdministratorImpl $user
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
        $persistenceId = $user->getId();
        $stmt->bindParam(1, $persistenceId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'User deleted successfully';
        }
        else{
            throw new RDException('Deletion of User successful');
        }
    }


}
