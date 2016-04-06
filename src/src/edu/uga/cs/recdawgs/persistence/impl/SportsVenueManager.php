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
            $stmt->bindParam(1, $sportsVenue->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $sportsVenue->getAddress(), \PDO::PARAM_STR);
            $isIndoor = ($sportsVenue->getIsIndoor() ? 1 : 0);
            $stmt->bindParam(3, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(4, $sportsVenue->getId(), \PDO::PARAM_INT);
            
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
            $stmt->bindParam(1, $sportsVenue->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $sportsVenue->getAddress(), \PDO::PARAM_STR);
            $isIndoor = ($sportsVenue->getIsIndoor() ? 1 : 0);
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

    public function storeLeagueUsedIn($league, $sportsVenue){
        $q = "INSERT INTO league_venue (league_id, venue_id) VALUES(?, ?);";
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $sportsVenue->getId(), \PDO::PARAM_INT);

        if($stmt->execute()){
            echo 'link created successfully';
        }
        else{
            throw new RDException('Error creating link');
        }
    }

    public function restore($modelSportsVenue){
        $q = 'SELECT * from sports_venue WHERE 1=1 ;';
        if($modelSportsVenue != NULL) {
            if ($attr = $modelSportsVenue->getName() != NULL) {
                $q .= ' AND sports_venue.name = ' . $attr;
            }
            if ($attr = $modelSportsVenue->getAddress() != NULL) {
                $q .= ' AND address = ' . $attr;
            }
            if ($attr = $modelSportsVenue->getIsIndoor() != NULL) {
                $q .= ' AND is_indoor = ' . ($attr ? 1 : 0);
            }

            if ($attr = $modelSportsVenue->getId() != NULL){
                $q .= ' AND sports_venue_id = ' . $attr;
            }
        }
        $stmt = $this->dbConnection->prepare($q);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new SportsVenueIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring student model');
        }
    }

    public function restoreLeaguesUsedIn($sportsVenue){
        $q = 'SELECT league.league_id, league.name, league, league_rules,
               league.match_rules, league.is_indoor, league.min_teams, league.max_teams, league.min_members, league.max_members
              FROM league
              INNER JOIN league_venue
              ON league.league_id = league_venue.league_id
              WHERE league_venue.venue_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $sportsVenue->getId(), \PDO::PARAM_INT);
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

    public function deleteLeagueUsedIn($league, $sportsVenue){
        //Prepare mySQL query
        $q = 'DELETE FROM league_venue WHERE venue_id = ? AND league_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $sportsVenue->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'link deleted successfully';
        }
        else{
            throw new RDException('Deletion of lnik unsuccessful');
        }
    }

    public function delete($sportsVenue){
        if($sportsVenue->getId() == -1){
            //if venue isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM sports_venue WHERE sports_venue_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $sportsVenue->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'venue deleted successfully';
        }
        else{
            throw new RDException('Deletion of venue unsuccessful');
        }
    }

}