<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 13:37
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class MatchManager {
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
     * Creates Match in database.
     *
     * @param Entity\MatchImpl $match
     * @throws RDException
     */
    public function save($match){
        if($match->isPersistent()){
            //update
            $q = "UPDATE " . DB_NAME . ".match" .
                "set home_points = ?,
              away_points = ?,
              match.date = ?,
              is_completed = ?,
              home_team_id = ?,
              away_team_id = ?,
              sports_venue_id = ?,
              round_id = ?
              WHERE match_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q . ';');


            $homePoints = $match->getHomePoints();
            $awayPoints = $match->getAwayPoints();
            $date = $match->getDate();
            //bind parameters to prepared statement
            $stmt->bindParam(1, $homePoints, \PDO::PARAM_INT);
            $stmt->bindParam(2, $awayPoints, \PDO::PARAM_INT);
            $stmt->bindParam(3, $date);
            $completed = ($match->getIsCompleted() ? 1 : 0);
            $stmt->bindParam(4, $completed, \PDO::PARAM_INT);
            if($match->getHomeTeam() != NULL ) {
                $homeTeam = $match->getHomeTeam()->getId();
                $stmt->bindParam(5, $homeTeam, \PDO::PARAM_INT);
            }
            if($match->getAwayTeam() != NULL) {
                $awayTeam = $match->getAwayTeam()->getId();
                $stmt->bindParam(6, $awayTeam, \PDO::PARAM_INT);
            }
            if($match->getSportsVenue() != NULL) {
                $sportsVenue = $match->getSportsVenue()->getId();
                $stmt->bindParam(7, $sportsVenue, \PDO::PARAM_INT);
            }
            $round = $match->getRound()->getId();
            $matchID = $match->getId();
            $stmt->bindParam(8, $round, \PDO::PARAM_INT);
            $stmt->bindParam(9, $matchID, \PDO::PARAM_INT);

            if($stmt->execute()){
                echo 'Match created successfully';
            }
            else{
                throw new RDException('Error creating match');
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO " . DB_NAME . ".match (home_points, away_points, date, is_completed,
              home_team_id, away_team_id, sports_venue_id, round_id)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q . ';');
            //bind parameters to prepared statement
            $homePoints = $match->getHomePoints();
            $awayPoints = $match->getAwayPoints();
            $date = $match->getDate();
            //bind parameters to prepared statement
            $stmt->bindParam(1, $homePoints, \PDO::PARAM_INT);
            $stmt->bindParam(2, $awayPoints, \PDO::PARAM_INT);
            $stmt->bindParam(3, $date);
            $completed = ($match->getIsCompleted() ? 1 : 0);
            $stmt->bindParam(4, $completed, \PDO::PARAM_INT);
            if($match->getHomeTeam() != NULL ) {
                $homeTeam = $match->getHomeTeam()->getId();
                $stmt->bindParam(5, $homeTeam, \PDO::PARAM_INT);
            }
            if($match->getAwayTeam() != NULL) {
                $awayTeam = $match->getAwayTeam()->getId();
                $stmt->bindParam(6, $awayTeam, \PDO::PARAM_INT);
            }
            if($match->getSportsVenue() != NULL) {
                $sportsVenue = $match->getSportsVenue()->getId();
                $stmt->bindParam(7, $sportsVenue, \PDO::PARAM_INT);
            }
            $round = $match->getRound()->getId();
            $stmt->bindParam(8, $round, \PDO::PARAM_INT);
            if($stmt->execute()){
                $match->setId($this->dbConnection->lastInsertId());
                echo 'Match created successfully';
            }
            else{
                throw new RDException('Error creating match: ' . print_r($stmt->errorInfo()));
            }
        }


    }

    /**
     * Stores home team in database.
     * 
     * @param $team to store as home team
     * @param $match to link home team with
     * @throws RDException
     */
    public function storeHomeTeam($team, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              home_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $teamId = $team->getId();
        $matchId = $match->getId();
        $stmt->bindParam(1, $teamId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Home team link created successfully';
        }
        else{
            throw new RDException('Error create link');
        }
    }

    /**
     * Stores away team in database.
     *
     * @param $team to store as away team
     * @param $match to link away team with
     * @throws RDException
     */
    public function storeAwayTeam($team, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              away_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $teamId = $team->getId();
        $matchId = $match->getId();
        $stmt->bindParam(1, $teamId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away team link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }


    /**
     * Stores SportsVenue in database.
     *
     * @param $match to link the venue with
     * @param $sportsVenue to store
     * @throws RDException
     */
    public function storeSportsVenue($match, $sportsVenue){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              sports_venue_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $sportsVenueId = $sportsVenue->getId();
        $matchId = $match->getId();
        $stmt->bindParam(1, $sportsVenueId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away venue link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }

    /**
     * Stores Round object in database.
     * 
     * @param $round to store
     * @param $match to link the round with
     * @throws RDException
     */
    public function storeRound($round, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              round_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement

        $roundId = $round->getId();
        $matchId = $match->getId();
        $stmt->bindParam(1, $roundId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Round match link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }

    /**
     * Restore SportsVenue object.
     *
     * @param $match that the sports venue is associated with
     * @return SportsVenue corresponding to that match
     * @throws RDException
     */
    public function restoreSportsVenue($match){
        if($match == NULL || !$match->isPersistent()) {
            throw new RDException('Match is not persistent');
        }

        $q = 'SELECT * from sports_venue where sports_venue_id = (SELECT sports_venue_id FROM '. DB_NAME  .'.match WHERE match_id = ?);';
        $stmt = $this->dbConnection->prepare($q);

        $matchId = $match->getId();
        $stmt->bindParam(1, $matchId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return one result since there is only 1
            $sportsVenueIter =  new SportsVenueIterator($resultSet, $this->objLayer);
            return $sportsVenueIter->current();
        }
        else{
            throw new RDException('Error restoring sports venue');
        }
    }

    /*
     * Restores match.
     *
     * @param Entity\MatchImpl $modelMatch match to store
     * @return MatchIterator
     * @throws RDException
     */
    public function restore($modelMatch){
        //echo 'model match contents: ' . var_dump($modelMatch);
        $q = 'SELECT * from ' . DB_NAME. '.match WHERE 1=1 ';
        if($modelMatch != NULL) {
            if ($modelMatch->getHomePoints() != NULL) {
                $q .= ' AND home_points = ' . $modelMatch->getHomePoints();
            }
            if ($modelMatch->getAwayPoints() != NULL) {
                $q .= ' AND away_points = ' . $modelMatch->getAwayPoints();
            }
            if ($modelMatch->getDate() != NULL) {
                $q .= ' AND date = ' . $modelMatch->getDate();
            }
            if ($modelMatch->getIsCompleted() != NULL) {
                $q .= ' AND is_completed = ' . ($modelMatch->getIsCompleted()) ? 1 : 0;
            }
            $attr = NULL;
            if ($modelMatch->getHomeTeam() != NULL) {
                $attr = $modelMatch->getHomeTeam()->gectId();
                $q .= ' AND home_team_id = ' . $attr;
            }
            $attr = NULL;
            if ($modelMatch->getAwayTeam()!= NULL) {
                $attr = $modelMatch->getAwayTeam()->getId();
                $q .= ' AND away_team_id = ' . $attr;
            }
            $attr = NULL;
            if ($modelMatch->getSportsVenue() != NULL){
                $attr = $modelMatch->getSportsVenue()->getId();
                $q .= ' AND sports_venue_id = ' . $attr;
            }
            if ($modelMatch->getId() != NULL){
                $q .= ' AND match_id = ' . $modelMatch->getId();
            }
        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new MatchIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring match model' . print_r($stmt->errorInfo()));
        }
    }

    /**
     * Return the home team that participated in this match.
     *
     * @param $match
     * @throws RDException
     * @return Entity\TeamImpl The home team of the match
     */
    public function restoreHomeTeam($match){
        if($match == NULL || !$match->isPersistent()) {
            throw new RDException('Match is not persistent');
        }

        $q = 'SELECT * FROM team WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q );
        $homeTeamId = $match->getHomeTeam()->getId();
        $stmt->bindParam(1, $homeTeamId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return one result since there is only 1
            $teamIter =  new TeamIterator($resultSet, $this->objLayer);
            return $teamIter->current();
        }
        else{
            throw new RDException('Error restoring home team');
        }
    }

    /**
     * Return the away team that participated in this match.
     *
     * @param $match
     * @throws RDException
     * @return Entity\TeamImpl The away team of the match
     */
    public function restoreAwayTeam($match){
        if($match == NULL || !$match->isPersistent()) {
            throw new RDException('Match is not persistent');
        }

        $q = 'SELECT * FROM team WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $awayTeamId = $match->getAwayTeam()->getId();
        $stmt->bindParam(1, $awayTeamId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return one result since there is only 1
            $teamIter =  new TeamIterator($resultSet, $this->objLayer);
            return $teamIter->current();
        }
        else{
            throw new RDException('Error restoring away team');
        }
    }


    /**
     * Deletes match.
     *
     * @param $match to delete
     * @throws RDException
     */
    public function delete($match){
        if($match->getId() == -1){
            //if match isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM ' . DB_NAME . '.match WHERE match_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $matchId = $match->getId();
        $stmt->bindParam(1, $matchId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'match deleted successfully';
        }
        else{
            throw new RDException('Deletion of match unsuccessful');
        }
    }

    /**
     * Deletes home team.
     * 
     * @param $match with the corresponding home team
     * @throws RDException
     */
    public function deleteHomeTeam($match){
        if($match->getId() == -1){
            //if match isn't persistent, we are done
            return;
        }

        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              home_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $null = NULL;
        $stmt->bindParam(1, $null);
        $matchId = $match->getId();
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Home team link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }

    /**
     * Deletes away team.
     * 
     * @param $match with corresponding away team
     * @throws RDException
     */
    public function deleteAwayTeam($match){
        if($match->getId() == -1){
            //if match isn't persistent, we are done
            return;
        }
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              away_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $null = NULL;
        $stmt->bindParam(1, $null);
        $matchId = $match->getId();
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away team link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }


    /**
     * Deletes sports venue.
     * 
     * @param $match corresponding with that sports venue
     * @throws RDException
     */
    public function deleteSportsVenue($match){
        if($match->getId() == -1){
            //if match isn't persistent, we are done
            return;
        }
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              sports_venue_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $null = NULL;
        $stmt->bindParam(1, $null);
        $matchId = $match->getId();
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'venue link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }

    /**
     * Deletes round.
     * 
     * @param $round to delete
     * @param $match corresponding with that round
     * @throws RDException
     */
    public function deleteRound($round, $match){
        if($match->getId() == -1 && $round->getId() == -1){
            throw new RDException('neither objects are persistent');
        }
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              round_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $null = NULL;
        $stmt->bindParam(1, $null);
        $matchId = $match->getId();
        $stmt->bindParam(2, $matchId, \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }

    }

}
