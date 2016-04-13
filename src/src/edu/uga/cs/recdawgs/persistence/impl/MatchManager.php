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
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }

    /**
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
            //bind parameters to prepared statement
            $stmt->bindParam(1, $match->getHomePoints(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $match->getAwayPoints(), \PDO::PARAM_INT);
            $stmt->bindParam(3, $match->getDate());
            $completed = ($match->getIsCompleted() ? 1 : 0);
            $stmt->bindParam(4, $completed, \PDO::PARAM_INT);
            $stmt->bindParam(5, $match->getHomeTeam()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(6, $match->getAwayTeam()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(7, $match->getSportsVenue()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(8, $match->getRound()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(9, $match->getId(), \PDO::PARAM_INT);

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
            $stmt->bindParam(1, $match->getHomePoints(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $match->getAwayPoints(), \PDO::PARAM_INT);
            $stmt->bindParam(3, $match->getDate());
            $completed = ($match->getIsCompleted() ? 1 : 0);
            $stmt->bindParam(4, $completed, \PDO::PARAM_INT);
            $stmt->bindParam(5, $match->getHomeTeam()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(6, $match->getAwayTeam()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(7, $match->getSportsVenue()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(8, $match->getRound()->getId(), \PDO::PARAM_INT);
            if($stmt->execute()){
                $match->setId($this->dbConnection->lastInsertId());
                echo 'Match created successfully';
            }
            else{
                throw new RDException('Error creating match: ' . print_r($stmt->errorInfo()));
            }
        }


    }

    public function storeHomeTeam($team, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              home_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Home team link created successfully';
        }
        else{
            throw new RDException('Error create link');
        }
    }

    public function storeAwayTeam($team, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              away_team_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away team link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }
    public function storeSportsVenue($match, $sportsVenue){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              sports_venue_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $sportsVenue->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away venue link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }

    public function storeRound($round, $match){
        $q = "UPDATE " . DB_NAME . ".match" .
            "set
              round_id = ?,
              WHERE match_id = ?;";

        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $round->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Round match link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }

    public function restoreSportsVenue($match){
        if($match == NULL || !$match->isPersistent()) {
            throw new RDException('Match is not persistent');
        }

        $q = 'SELECT * from sports_venue where sports_venue_id = (SELECT sports_venue_id FROM '. DB_NAME  .'.match WHERE match_id = ?);';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $match->getId(), \PDO::PARAM_INT);
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

    /**
     *
     * restore match
     *
     * @param $modelMatch
     * @return MatchIterator
     * @throws RDException
     */
    public function restore($modelMatch){
        //echo 'model match contents: ' . var_dump($modelMatch);
        $q = 'SELECT * from ' . _NAME. '.match WHERE 1=1 ';
        if($modelMatch != NULL) {
            if ($attr = $modelMatch->getHomePoints() != NULL) {
                $q .= ' AND home_points = ' . $attr;
            }
            if ($attr = $modelMatch->getAwayPoints() != NULL) {
                $q .= ' AND away_points = ' . $attr;
            }
            if ($attr = $modelMatch->getDate() != NULL) {
                $q .= ' AND date = ' . $attr;
            }
            if ($attr = $modelMatch->getIsCompleted() != NULL) {
                $q .= ' AND is_completed = ' . ($attr) ? 1 : 0;
            }
            if ($attr = $modelMatch->getHomeTeam()->getId() != NULL) {
                $q .= ' AND home_team_id = ' . $attr;
            }
            if ($attr = $modelMatch->getAwayTeam()->getId() != NULL) {
                $q .= ' AND away_team_id = ' . $attr;
            }
            if ($attr = $modelMatch->getSportsTeam()->getId() != NULL) {
                $q .= ' AND sports_team_id = ' . $attr;
            }
            if ($attr = $modelMatch->getId() != NULL){
                $q .= ' AND match_id = ' . $attr;
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
            throw new RDException('Error restoring match model');
        }
    }

    /**
     * Return the home team that participated in this match
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
        $stmt->bindParam(1, $match->getHomeTeam()->getId(), \PDO::PARAM_INT);
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
     * Return the away team that participated in this match
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
        $stmt->bindParam(1, $match->getAwayTeam()->getId(), \PDO::PARAM_INT);
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
        $stmt->bindParam(1, $match->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'match deleted successfully';
        }
        else{
            throw new RDException('Deletion of match successful');
        }
    }

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
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Home team link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }

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
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'away team link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }
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
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'venue link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }
    }

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
        $stmt->bindParam(2, $match->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Error deleting link');
        }

    }

}
