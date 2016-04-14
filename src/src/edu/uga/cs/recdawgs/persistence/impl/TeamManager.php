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

    /**
     * Constructor
     *
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }


    /**
     * Creates or updates team in database.
     * 
     * @param $team
     * @throws RDException
     */
    public function save($team){

        if($team->isPersistent()){
            //update
            $q = "UPDATE team
              set team.name = ?,
              captain_id = ?
               WHERE team_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $team->getName(), \PDO::PARAM_STR);
            if($team->getCaptain() != NULL) {
                $stmt->bindParam(2, $team->getCaptain()->getId(), \PDO::PARAM_INT);
            }
            $stmt->bindParam(3, $team->getId(), \PDO::PARAM_INT);

            //echo $q;
            if($stmt->execute()){
                echo 'team updated successfully';
            }
            else{
                throw new RDException('Error updating team' . print_r($stmt->errorInfo()));
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO team10.team (team.name, captain_id) VALUES(?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $team->getName(), \PDO::PARAM_STR);
            if($team->getCaptain() != NULL) {
                $stmt->bindParam(2, $team->getCaptain()->getId(), \PDO::PARAM_INT);
            }
            if($stmt->execute()){
                $team->setId($this->dbConnection->lastInsertId());
                echo '
                Team created successfully
                ';
            }
            else{
                throw new RDException('Error creating team');
            }
        }
    }

    /**
     * Adds student as member of team.
     * 
     * @param Entity\AdministratorImpl $student
     * @param Entity\TeamImpl $team
     * @throws RDException
     */
    public function storeStudentMemberOf($student, $team){
       $q = 'INSERT INTO is_member_of (user_id, team_id) VALUES(?, ?);';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $student->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo "
            {$student->getFirstName()} {$student->getLastName()} successfully added as team member of: " . $team->getName();
        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully added as team member of: ' . $team->getName());
        }
    }

    /**
     * Stores link between captain and team.
     * 
     * @param Entity\StudentImpl $student
     * @param Entity\TeamImpl $team
     * @throws RDException
     */
    public function storeStudentCaptainOf($student, $team){
        $q = 'UPDATE team10.team SET captain_id = ? WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $student->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo "
            {$student->getFirstName()} {$student->getLastName()} successfully added as team captain of: " . $team->getName();

        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully added as team captain of: ' . $team->getName());
        }
    }

    /**
     * Stores link between league and team.
     * 
     * @param $team
     * @param $league
     * @throws RDException
     */
    public function storeParticipatesIn($team, $league){
        $q = 'INSERT INTO league_team (team_id, league_id) VALUES(?, ?);';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $league->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Link successfully created';
        }
        else{
            throw new RDException('Link unsuccessfully created');
        }
    }

    private function wrap($str){
        return "'" . $str . "'";
    }


    /**
     * Restores team in database.
     * 
     * @param $modelTeam to restore
     * @return TeamIterator 
     * @throws RDException
     */
    public function restore($modelTeam){
        //echo 'teammanager restore' . var_dump($modelTeam);
        $q = 'SELECT * from team10.team WHERE 1=1 ';
        if($modelTeam != NULL) {
            if ($modelTeam->getName() != NULL) {
                $q .= ' AND name = ' . $this->wrap($modelTeam->getName());
            }

            $attr = NULL;
            if ($modelTeam->getCaptain() != NULL) {
                $attr = $modelTeam->getCaptain()->getId();
                $q .= ' AND captain_id = ' . $attr;
            }
            if ($modelTeam->getId() != -1 ){
                $q .= ' AND team_id = ' . $modelTeam->getId();
            }

        }
        //echo 'query: ' . $q;
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new TeamIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring team model' . print_r($stmt->errorInfo()));
        }
    }

    /** 
     * Restores team members.
     * 
     * @param $team
     * @return StudentIterator
     * @throws RDException
     */
    public function restoreStudentMemberOf($team){
        if($team == null) throw new RDException('Team parameter is null');

        $q = 'SELECT user.user_id, user.first_name, user.last_name, user.user_name,
              user.password, user.email_address, user.student_id, user.major, user.address, user.user_type
              from ' . DB_NAME .  '.user INNER JOIN is_member_of
               ON is_member_of.user_id = user.user_id
               WHERE is_member_of.team_id = ?;';

        //echo $q;
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iter
            return new StudentIterator($resultSet, $this->objLayer);

        }
        else{
            throw new RDException('Error restoring team members: ' . print_r($stmt->errorInfo()));
        }
    }

    /**
     * Restores away matches.
     * 
     * @param $team
     * @return MatchIterator
     * @throws RDException
     */
    public function restoreMatchesAway($team){
        $q = 'SELECT * FROM '. DB_NAME .  '.match WHERE away_team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iter
            return new MatchIterator($resultSet, $this->objLayer);

        }
        else{
            throw new RDException('Error restoring matches');
        }
    }

    /**
     * Restores home matches.
     * 
     * @param $team
     * @return MatchIterator
     * @throws RDException
     */
    public function restoreMatchesHome($team){
        $q = 'SELECT * FROM '. DB_NAME .  '.match WHERE home_team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iter
            return new MatchIterator($resultSet, $this->objLayer);

        }
        else{
            throw new RDException('Error restoring matches');
        }
    }

    /**
     * Return captain of this team.
     * 
     * @param Entity\TeamImpl $team
     * @return Entity\StudentImpl
     * @throws RDException
     */
    public function restoreStudentCaptainOf($team){
        if($team == null) throw new RDException('Team parameter is null');

        $q = 'SELECT * from ' . DB_NAME .  '.user WHERE user.user_id = ? ';

        $stmt = $this->dbConnection->prepare($q . ';');
        $stmt->bindParam(1, $team->getCaptain()->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return first obj
            $studentIter = new StudentIterator($resultSet, $this->objLayer);
            return $studentIter->current();
        }
        else{
            throw new RDException('Error restoring team captain');
        }
    }

    /**
     * Restores league.
     * 
     * @param $team
     * @return LeagueIterator
     * @throws RDException
     */
    public function restoreParticipatesIn($team){
        //echo 'team manager line 303'. var_dump($team);
        if($team == null) throw new RDException('Team parameter is null');

        $q = 'SELECT * from league WHERE league_id = (SELECT league_id FROM league_team WHERE team_id =' . $team->getId() .  ' );';

        $stmt = $this->dbConnection->prepare($q);
        //$stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return first obj

            return new LeagueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring league');
        }
    }

    /**
     * Restores winner of league.
     * 
     * @param Entity\TeamImpl $team
     * @return Entity\LeagueImpl
     * @throws RDException
     */
    public function restoreLeagueWinnerOf($team){
        if($team == null) throw new RDException('Team parameter is null');

        $q = 'SELECT * from league WHERE league_id = (SELECT league_id FROM league_team WHERE team_id = ? LIMIT 1);';

        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return first obj
            return (new LeagueIterator($resultSet, $this->objLayer))->current();
        }
        else{
            throw new RDException('Error restoring league');
        }
    }

    /**
     * Delete a specific team from the database.
     *
     * @param Entity/TeamImpl $team
     * @throws RDException
     */
    public function delete($team){
        if(!$team->isPersistent()){
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
            echo 'Team deleted successfully

            ';
        }
        else{
            throw new RDException('Deletion of Team unsuccessful');
        }
    }

    /**
     * Deletes the winning team. 
     * 
     * @param $league
     * @param $team
     */
    public function deleteTeamWinnerOf($league, $team){

    }

    /**
     * Deletes the link between league and team.
     * 
     * @param $league
     * @param $team
     * @throws RDException
     */
    public function deleteParticipatesIn($league, $team){
        if($team->getId() == -1){
            //if team isn't persistent, we are done
            return;
        }
        //Prepare mySQL query
        $q = 'DELETE FROM league_team WHERE team_id = ? AND league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $league->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'Link deleted successfully ';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }
    
    /**
     * Deletes link between student and team.
     * 
     * @param $student
     * @param $team
     * @throws RDException
     */
    public function deleteStudentMemberOf($student, $team){
        //Prepare mySQL query
        $q = 'DELETE FROM is_member_of WHERE team_id = ? and user_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $student->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully ';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }
    
    /**
     * Deletes captain from team.
     * 
     * @param $student
     * @param $team
     * @throws RDException
     */
    public function deleteStudentCaptainOf($student, $team){
        $q = 'UPDATE team SET captain_id = ? WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $null = null;
        $stmt->bindParam(1, $null);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo "{$student->getFirstName()} {$student->getLastName()} successfully removed as team captain of: " . $team->getName();
        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully removed as team captain of: ' . $team->getName());
        }
    }

}