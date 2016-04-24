<?php
/**
 * Created by PhpStorm.
 * User: mwong
 * Date: 4/6/16
 * Time: 3:22 PM
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class SportsVenueManager {
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
     * creates sports venue
     * 
     * @param Entity\SportsVenueImpl $sportsVenue
     * @throws RDException
     */
    public function save($sportsVenue){
        if($sportsVenue->isPersistent()){
            //update
            $q = "UPDATE sports_venue
                set sports_venue.name = ?,
              address = ?,
              is_indoor = ?
              WHERE sports_venue_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $sportsVenueName = $sportsVenue->getName();
            $address = $sportsVenue->getAddress();
            $isIndoor = ($sportsVenue->getIsIndoor() ? 1 : 0);
            $sportsVenueId = $sportsVenue->getId();
            $stmt->bindParam(1, $sportsVenueName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $address, \PDO::PARAM_STR);
            $stmt->bindParam(3, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(4, $sportsVenueId, \PDO::PARAM_INT);
            
            if($stmt->execute()){
                echo 'venue created successfully';
            }
            else{
                throw new RDException('Error creating venue');
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO sports_venue (sports_venue.name, address, is_indoor) VALUES(?, ?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement

            $sportsVenueName = $sportsVenue->getName();
            $address = $sportsVenue->getAddress();
            $isIndoor = ($sportsVenue->getIsIndoor() ? 1 : 0);
            $stmt->bindParam(1, $sportsVenueName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $address, \PDO::PARAM_STR);
            $stmt->bindParam(3, $isIndoor, \PDO::PARAM_INT);

            if($stmt->execute()){
                $sportsVenue->setId($this->dbConnection->lastInsertId());
                echo 'venue created successfully';
            }
            else{
                throw new RDException('venue creating match');
            }
        }
    }


    /**
     * stores link between league and sports venue
     *
     * @param $league
     * @param $sportsVenue
     * @throws RDException
     */
    public function storeLeagueUsedIn($league, $sportsVenue){
        $q = "INSERT INTO league_venue (league_id, venue_id) VALUES(?, ?);";
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement

        $leagueId = $league->getId();
        $sportsVenueId = $sportsVenue->getId();
        $stmt->bindParam(1, $leagueId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $sportsVenueId, \PDO::PARAM_INT);

        if($stmt->execute()){
            echo 'link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }
    private function wrap($str){
        return "'" . $str . "'";
    }

    /**
     * restore sports venue in database
     *
     * @param $modelSportsVenue to store
     * @return SportsVenueIterator
     * @throws RDException
     */
    public function restore($modelSportsVenue){
        $q = 'SELECT * from sports_venue WHERE 1=1 ';
        if($modelSportsVenue != NULL) {
            if ($modelSportsVenue->getName() != NULL) {
                $q .= ' AND sports_venue.name = ' . $this->wrap($modelSportsVenue->getName());
            }
            if ($modelSportsVenue->getAddress() != NULL) {
                $q .= ' AND address = ' . $this->wrap($modelSportsVenue->getAddress());
            }
            if ($modelSportsVenue->getIsIndoor() != NULL) {
                $q .= ' AND is_indoor = ' . ($modelSportsVenue->getIsIndoor() ? 1 : 0);
            }

            if ( $modelSportsVenue->getId() != -1){
                $q .= ' AND sports_venue_id = ' . $modelSportsVenue->getId();
            }
        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new SportsVenueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring sports venue model');
        }
    }

    /**
     * restore league used in given sports venue
     *
     * @param $sportsVenue
     * @return LeagueIterator
     * @throws RDException
     */
    public function restoreLeaguesUsedIn($sportsVenue){
        $q = 'SELECT league.league_id, league.name, league, league_rules,
               league.match_rules, league.is_indoor, league.min_teams, league.max_teams, league.min_members, league.max_members
              FROM league
              INNER JOIN league_venue
              ON league.league_id = league_venue.league_id
              WHERE league_venue.venue_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $sportsVenueId = $sportsVenue->getId();
        $stmt->bindParam(1, $sportsVenueId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new LeagueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring leagues using this sports venue');
        }

    }

    /**
     * restores matches played at the sports venue
     *
     * @param $sportsVenue
     * @return MatchIterator
     * @throws RDException
     */
    public function restoreMatchesPlayedIn($sportsVenue){
        $q = 'SELECT * FROM '. DB_NAME . '.match WHERE match.sports_venue_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $sportsVenueId = $sportsVenue->getId();
        $stmt->bindParam(1, $sportsVenueId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new MatchIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring matches using this sports venue');
        }
    }

    /**
     * deletes link between league and sports venue
     *
     * @param $league
     * @param $sportsVenue
     * @throws RDException
     */
    public function deleteLeagueUsedIn($league, $sportsVenue){
        //Prepare mySQL query
        $q = 'DELETE FROM league_venue WHERE venue_id = ? AND league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $sportsVenueId = $sportsVenue->getId();
        $leagueId = $league->getId();
        $stmt->bindParam(1, $sportsVenueId, \PDO::PARAM_INT);
        $stmt->bindParam(2, $leagueId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo "Link deleted successfully";
        }
        else{
            throw new RDException('Deletion of link unsuccessful');
        }
    }

    /**
     * deletes sports venue
     *
     * @param $sportsVenue to delete
     * @throws RDException
     */
    public function delete($sportsVenue){
        if(!$sportsVenue->isPersistent()){
            //if venue isn't persistent, we are done
            return;
        }

        //echo 'before: ' . var_dump($sportsVenue);

        //Prepare mySQL query
        $q = 'DELETE FROM sports_venue WHERE sports_venue_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $sportsVenueId = $sportsVenue->getId();
        $stmt->bindParam(1, $sportsVenueId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'venue deleted successfully';
        }
        else{
            throw new RDException('Deletion of venue unsuccessful');
        }
    }

}