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
            $stmt->bindParam(1, $league->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $league->getLeagueRules(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $league->getMatchRules(), \PDO::PARAM_STR);
            $isIndoor = ($league->getIsIndoor() ? 1 : 0);
            $stmt->bindParam(4, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(5, $league->getMinTeams, \PDO::PARAM_INT);
             $stmt->bindParam(6, $league->getMaxTeams, \PDO::PARAM_INT);
             $stmt->bindParam(7, $league->getMinMembers, \PDO::PARAM_INT);
             $stmt->bindParam(8, $league->getMaxMembers, \PDO::PARAM_INT);
             $stmt->bindParam(9, $league->getId(), \PDO::PARAM_INT);
      
            
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
            $q = "INSERT INTO league (leauge.name, league.league_rules, league.match_rules, is_indoor, min_teams, max_teams, min_members, max_members) VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
         
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
             $stmt->bindParam(1, $league->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $league->getLeagueRules(), \PDO::PARAM_STR);
            $stmt->bindParam(3, $league->getMatchRules(), \PDO::PARAM_STR);
            $isIndoor = ($league->getIsIndoor() ? 1 : 0);
            $stmt->bindParam(4, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(5, $league->getMinTeams, \PDO::PARAM_INT);
             $stmt->bindParam(6, $league->getMaxTeams, \PDO::PARAM_INT);
             $stmt->bindParam(7, $league->getMinMembers, \PDO::PARAM_INT);
             $stmt->bindParam(8, $league->getMaxMembers, \PDO::PARAM_INT);

            if($stmt->execute()){
                $sportsVenue->setId($this->dbConnection->lastInsertId());
                echo 'league created successfully';
            }
            else{
                throw new RDException('league creating match');
            }
        }
    }

    public function storeWinner($team, $league){
        //create entry in is_winner_of table
        $q = 'INSERT INTO is_winner_of (team_id, league_id) VALUES(?, ?);';
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $league->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Link created successfully';
        }
        else{
            throw new RDException('Error creating ');
        }
    }

    public function storeRound($league, $round) {
        if ($league->isPersistent() && $round->isPersistent()) {
            //update
            $q = "UPDATE score_report
                set league_id = ?,
              WHERE round_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $round->getId(), \PDO::PARAM_INT);

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
     * Return winner of this league
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
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
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

    public function restoreSportsVenues($league){
        $q = 'SELECT sports_venue.sports_venue_id, sports_venue.name, sports_venue.address, sports_venue.is_indoor
            from sports_venue
            INNER JOIN league_venue
            ON sports_venue.sports_venue_id = league_venue.venue_id
            WHERE league_venue.league_id =  ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
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


    public function restoreRounds($league){
        $q = 'SELECT * from '. DB_NAME . '.round' .
            'WHERE league_id =  ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return (new RoundIterator($resultSet, $this->objLayer));
        }
        else{
            throw new RDException('Error restoring rounds');
        }
    }

    public function restore($leagueModel){
          $q = 'SELECT * from league WHERE 1=1 ';
        if($leagueModel != NULL) {
            if($attr = $leagueModel->getName() != NULL) {
                $q .= ' AND league.name = ' . $attr;   
            }
            if($attr = $leagueModel->getLeagueRules() != NULL) {
                $q .= ' AND league.league_rules = ' . $attr;   
            }
            if ($attr = $leagueModel->getMatchRules() != NULL) {
                $q .= ' AND league.match_rules = ' . $attr;
            }
            
            if ($attr = $leagueModel->getIsIndoor() != NULL) {
                $q .= ' AND is_indoor = ' . ($attr ? 1 : 0);
            }
            if ($attr = $leagueModel->getMinTeams() != NULL) {
                $q .= ' AND min_teams = ' . $attr;
            }
            if ($attr = $leagueModel->getMaxTeams() != NULL) {
                $q .= ' AND max_teams = ' . $attr;
            }
            if ($attr = $leagueModel->getMinMembers() != NULL) {
                $q .= ' AND min_members = ' . $attr;
            }
            if ($attr = $leagueModel->getMaxMembers() != NULL) {
                $q .= ' AND max_members = ' . $attr;
            }
            

            if ($attr = $leagueModel->getId() != NULL){
                $q .= ' AND league_id = ' . $attr;
            }
        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new LeagueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoringleague model');
        }
    }

    public function delete($league){
        if($sportsVenue->getId() == -1){
            //if league isn't persistent, return
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM league WHERE league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $sportsVenue->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'league deleted successfully';
        }
        else{
            throw new RDException('Deletion of venue unsuccessful');
        }
    }

    /**
     * @param Entity\TeamImpl $team
     * @param Entity\LeagueImpl $league
     * @throws RDException
     */
    public function deleteWinner($team, $league){
        $q = 'DELETE FROM is_winner_of WHERE team_id = ? AND league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $league->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }

    /**
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
        $stmt->bindParam(1, $null);
        $stmt->bindParam(2, $round->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }


}