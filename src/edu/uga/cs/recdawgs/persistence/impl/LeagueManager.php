<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/7/16
 * Time: 16:40
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;


class LeagueManager {
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
     * Saves league in database.
     *
     * @param Entity\LeagueImpl $league
     * @throws RDException
     */
    public function save($league){
        if($league->isPersistent()){
            //update
            $q = "UPDATE league
            set league.name = ?,
            league_rules = ?,
            match_rules = ?,
            is_indoor = ?,
            min_teams = ?,
            max_teams = ?,
            min_members = ?,
            max_members = ?
            WHERE league_id = ?;";
        
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement

            $name = $league->getName();
            $leagueRules = $league->getLeagueRules();
            $matchRules = $league->getMatchRules();
            $isIndoor = ($league->getIsIndoor() ? 1 : 0);
            $minTeams = $league->getMinTeams();
            $maxTeams = $league->getMaxTeams();
            $minMembers = $league->getMinMembers();
            $maxMembers = $league->getMaxMembers();
            $leagueId = $league->getId();

            $stmt->bindParam(1, $name, \PDO::PARAM_STR);
            $stmt->bindParam(2, $leagueRules, \PDO::PARAM_STR);
            $stmt->bindParam(3, $matchRules, \PDO::PARAM_STR);
            $stmt->bindParam(4, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(5, $minTeams, \PDO::PARAM_INT);
             $stmt->bindParam(6, $maxTeams, \PDO::PARAM_INT);
             $stmt->bindParam(7, $minMembers, \PDO::PARAM_INT);
             $stmt->bindParam(8, $maxMembers, \PDO::PARAM_INT);
             $stmt->bindParam(9, $leagueId, \PDO::PARAM_INT);
      
            
            if($stmt->execute()){
                echo 'league created successfully';
            }
            else{
                throw new RDException('Error creating league');
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO team10.league (league.name, league.league_rules, league.match_rules,
                    is_indoor, min_teams, max_teams, min_members, max_members)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
         
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement

            $name = $league->getName();
            $leagueRules = $league->getLeagueRules();
            $matchRules = $league->getMatchRules();
            $isIndoor = ($league->getIsIndoor() ? 1 : 0);
            $minTeams = $league->getMinTeams();
            $maxTeams = $league->getMaxTeams();
            $minMembers = $league->getMinMembers();
            $maxMembers = $league->getMaxMembers();

            $stmt->bindParam(1, $name, \PDO::PARAM_STR);
            $stmt->bindParam(2, $leagueRules, \PDO::PARAM_STR);
            $stmt->bindParam(3, $matchRules, \PDO::PARAM_STR);
            $stmt->bindParam(4, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(5, $minTeams, \PDO::PARAM_INT);
            $stmt->bindParam(6, $maxTeams, \PDO::PARAM_INT);
            $stmt->bindParam(7, $minMembers, \PDO::PARAM_INT);
            $stmt->bindParam(8, $maxTeams, \PDO::PARAM_INT);

            if($stmt->execute()){
                $league->setId($this->dbConnection->lastInsertId());
                echo 'league created successfully';
            }
            else{
                throw new RDException('error creating league, error info: ' . print_r($stmt->errorInfo()));
            }
        }
    }

    /**
     * Stores winner.
     *
     * @param $team object that wins
     * @param $league object
     * @throws RDException if there is a problem storing
     */
    public function storeWinner($team, $league){
        //create entry in is_winner_of table
        $q = 'INSERT INTO is_winner_of (team_id, league_id) VALUES(?, ?);';
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement

        $teamId = $team->getId();
        $leagueId = $league->getId();

        $stmt->bindParam(1, $teamId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $leagueId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Link created successfully';
        }
        else{
            throw new RDException('Error creating winner of league');
        }
    }

    /**
     * Stores round in database.
     * 
     * @param $league object to store
     * @param $round object to store
     * @throws RDException if score report cannot be stored.
     */
    public function storeRound($league, $round) {
        if ($league->isPersistent() && $round->isPersistent()) {
            //update
            $q = "UPDATE score_report
                set league_id = ?,
              WHERE round_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement

            $leagueId = $league->getId();
            $roundId = $round->getId();

            $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
            $stmt->bindParam(2, $roundId, \PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo 'link created successfully';
            } else {
                throw new RDException($string='Error creating link');
            }
        }
        else{
            throw new RDException($string='both objects need to be persistent');
        }
    }

    /**
     * Return winner of this league.
     *
     * @param Entity\LeagueImpl $league
     * @return Entity\TeamImpl
     * @throws RDException
     */
    public function restoreWinner($league){
        $q = 'SELECT team.team_id, team.name, team.captain_id
            from team
            INNER JOIN league_team
            ON team.team_id = league_team.team_id
            WHERE league_team.league_id =  ?
            LIMIT 1;';

        $stmt = $this->dbConnection->prepare($q);

        $leagueId = $league->getId();

        $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return (new TeamIterator($resultSet, $this->objLayer))->current();
        }
        else{
            throw new RDException('Error restoring winner');
        }
    }

    /**
     * Restores sports venues.
     * 
     * @param $league object to restore
     * @return SportsVenueIterator returns an iterator of sports venues
     * @throws RDException if there was a problem restoring the sports venue
     */
    public function restoreSportsVenues($league){
        $q = 'SELECT sports_venue.sports_venue_id, sports_venue.name, sports_venue.address, sports_venue.is_indoor
            from sports_venue
            INNER JOIN league_venue
            ON sports_venue.sports_venue_id = league_venue.venue_id
            WHERE league_venue.league_id =  ?;';
        $stmt = $this->dbConnection->prepare($q);

        $leagueId = $league->getId();

        $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return (new SportsVenueIterator($resultSet, $this->objLayer));
        }
        else{
            throw new RDException('Error restoring venues');
        }
    }


    /**
     * Restores rounds.
     * 
     * @param $league object to restore
     * @return RoundIterator: Iterators of the rounds object
     * @throws RDException If there was a problem restoring the rounds
     */
    public function restoreRounds($league){
        if(!isset($league)) throw new RDException($string="league is null");
        //echo 'LEAGUE VARIABLE: ' . var_dump($league);
        $q = 'SELECT * from '. DB_NAME . '.round' .
            ' WHERE league_id = ?;';
        $stmt = $this->dbConnection->prepare($q);

        $leagueId = $league->getId();

        $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return (new RoundIterator($resultSet, $this->objLayer));
        }
        else{
            throw new RDException('Error restoring rounds, ERROR MSG: '  . print_r($stmt->errorInfo()));
        }
    }

    /**
     * Restores team members participating in this league.
     * 
     * @param $league Object to store
     * @return TeamIterator: iterator of Teams
     * @throws RDException
     */
    public function restoreParticipatesIn($league){
        if($league == null) throw new RDException('League parameter is null');

        $q = 'SELECT team.team_id, team.name, team.captain_id
                FROM team10.team
                INNER JOIN league_team
                ON league_team.team_id = team.team_id
                WHERE league_team.league_id = ?;';

        $lgmt = $this->dbConnection->prepare($q);
        $leagueId = $league->getId();

        $lgmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        if ($lgmt->execute()){
            //get results from Query
            $resultSet = $lgmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iter
            return (new TeamIterator($resultSet, $this->objLayer));
        }
        else{
            throw new RDException('Error restoring team members');
        }

    }

    /**
     * @param $str
     * @return string
     */
    private function wrap($str){
        return "'" . $str . "'";
    }

    /**
     * Restores league.
     * 
     * @param Entity\LeagueImpl $leagueModel
     * @return LeagueIterator
     * @throws RDException
     */
    public function restore($leagueModel){
        //echo 'dump lague'.  var_dump($leagueModel);
          $q = 'SELECT * from league WHERE 1=1 ';
        if($leagueModel != NULL) {
            if($leagueModel->getName() != NULL) {
                $q .= ' AND league.name = ' . $this->wrap($leagueModel->getName());
            }
            if($leagueModel->getLeagueRules() != NULL) {
                $q .= ' AND league.league_rules = ' . $this->wrap($leagueModel->getLeagueRules());
            }
            if ($leagueModel->getMatchRules() != NULL) {
                $q .= ' AND league.match_rules = ' . $this->wrap($leagueModel->getMatchRules());
            }
            
            if ($leagueModel->getIsIndoor() != NULL) {
                $q .= ' AND is_indoor = ' . ($leagueModel->getIsIndoor() ? 1 : 0);
            }
            if ($leagueModel->getMinTeams() != NULL) {
                $q .= ' AND min_teams = ' . $leagueModel->getMinTeams();
            }
            if ($leagueModel->getMaxTeams() != NULL) {
                $q .= ' AND max_teams = ' . $leagueModel->getMaxTeams();
            }
            if ($leagueModel->getMinMembers() != NULL) {
                $q .= ' AND min_members = ' . $leagueModel->getMinMembers();
            }
            if ($leagueModel->getMaxMembers() != NULL) {
                $q .= ' AND max_members = ' . $leagueModel->getMaxMembers();
            }
            if ($leagueModel->getId() != -1){
                $q .= ' AND league_id = ' . $leagueModel->getId();
            }
        }

        //echo 'league wuery:' . $q;
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new LeagueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring league model' . print_r($stmt->errorInfo()));
        }
    }

    /**
     * Deletes league from database.
     *
     * @param Entity\LeagueImpl $league
     * @throws RDException
     */
    public function delete($league){
        if($league->getId() == -1){
            //if league isn't persistent, return
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM league WHERE league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $leagueId = $league->getId();
        $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'league deleted successfully';
        }
        else{
            throw new RDException('Deletion of venue unsuccessful');
        }
    }

    /**
     * Deletes winner.
     *
     * @param Entity\TeamImpl $team
     * @param Entity\LeagueImpl $league
     * @throws RDException
     */
    public function deleteWinner($team, $league){
        $q = 'DELETE FROM is_winner_of WHERE team_id = ? AND league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $teamId = $team->getId();
        $leagueId = $league->getId();

        $stmt->bindParam(1, $teamId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $leagueId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }

    /**
     * Deletes round.
     *
     * @param Entity\LeagueImpl $league
     * @param Entity\RoundImpl $round
     * @throws RDException
     */
    public function deleteRound($league, $round){
        $q = 'UPDATE '. DB_NAME .  '.round SET league_id = ? WHERE round_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $null = null;
        $roundId = $round->getId();
        $stmt->bindParam(1, $null);
        $stmt->bindParam(2, $roundId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }


}