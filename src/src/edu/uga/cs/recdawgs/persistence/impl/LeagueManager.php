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

    }

    public function delete($league){

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