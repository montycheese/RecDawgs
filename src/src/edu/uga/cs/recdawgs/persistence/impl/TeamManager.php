<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 12:25
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;


class TeamManager {
    private $dbConnection = null;
    private $objLayer = null;
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->dbConnection = $objLayer;
    }


    public function save($team){
        if($team->isPersistent()){
            //update
            $q = "UPDATE team
              set team.name = ?,
              captain_id = ?,
              WHERE team_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $team->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $team->getCaptain()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(3, $team->getId(), \PDO::PARAM_INT);
            if($stmt->execute()){
                echo 'team updated successfully';
            }
            else{
                throw new RDException('Error updating team');
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO team (team.name, captain_id VALUES(?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $team->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $team->getCaptain()->getId(), \PDO::PARAM_INT);
            if($stmt->execute()){
                $team->setId($this->dbConnection->lastInsertId());
                echo 'Team created successfully';
            }
            else{
                throw new RDException('Error creating team');
            }
        }
    }

    public function storeStudentMemberOf($student, $team){
        
    }

    /**
     * @param Entity\UserImpl $student
     * @param Entity\TeamImpl $team
     * @throws RDException
     */
    public function storeStudentCaptainOf($student, $team){
        $q = 'UPDATE team SET captain_id = ? WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $student->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo $student->getUserName() . ' successfully added as team captain of: ' . $team->getName();
        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully added as team captain of: ' . $team->getName());
        }
    }

    public function storeParticipatesIn($team, $league){

    }

    public function restore($modelTeam){
        $q = 'SELECT * from team WHERE 1=1 ';
        if($modelTeam != NULL) {
            if ($attr = $modelTeam->getName() != NULL) {
                $q .= ' AND name = ' . $attr;
            }
            if ($attr = $modelTeam->getCaptain()->getId() != NULL) {
                $q .= ' AND captain_id = ' . $attr;
            }
            if ($attr = $modelTeam->getId() != NULL) {
                $q .= ' AND team_id = ' . $attr;
            }

        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new TeamIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring team model');
        }
    }

    public function restoreStudentMemberOf($team){

    }

    public function restoreStudentCaptainOf($team){

    }

    public function restoreParticipatesIn($team){

    }
    public function restoreTeamWinnerOf($team){

    }

    /**
     * Delete a specific team from the database.
     *
     * @param Entity/TeamImpl $team
     * @throws RDException
     */
    public function delete($team){
        if($team->getId() == -1){
            //if team isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM team WHERE team_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'Team deleted successfully';
        }
        else{
            throw new RDException('Deletion of Team unsuccessful');
        }
    }

    public function deleteTeamWinnerOf($league, $team){

    }

    public function deleteParticipatesIn($team){

    }
    public function deleteStudentMemberOf($student, $team){

    }

}