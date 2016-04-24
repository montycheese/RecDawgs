<?php
/**
 * Created by PhpStorm.
 * User: mwong
 * Date: 4/7/16
 * Time: 12:23 PM
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class RoundManager {
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
     * Save round in database.
     * 
     * @param $round to store
     * @throws RDException
     */
    public function save($round){
        if($round->isPersistent()){
            //update
            $q = "UPDATE round
                set round.number = ?,
              league_id = ?
              WHERE round_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $roundNum = $round->getNumber();
            $leagueId = $round->getLeague()->getId();
            $roundId = $round->getId();
            $stmt->bindParam(1, $roundNum, \PDO::PARAM_INT);
            $stmt->bindParam(2, $leagueId, \PDO::PARAM_INT);
            $stmt->bindParam(3, $roundId, \PDO::PARAM_INT);
            if($stmt->execute()){
                echo 'round created successfully';
            }
            else{
                throw new RDException('Error creating round' . print_r($stmt->errorInfo()));
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO round (round.number, league_id) VALUES(?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $roundNum = $round->getNumber();
            $leagueId = $round->getLeague()->getId();
            $stmt->bindParam(1, $roundNum, \PDO::PARAM_INT);
            $stmt->bindParam(2, $leagueId, \PDO::PARAM_INT);

            if($stmt->execute()){
                $round->setId($this->dbConnection->lastInsertId());
                echo 'round created successfully';
            }
            else{
                throw new RDException('error creating round');
            }
        }
    }

    /**
     * Returns the round.
     * 
     * @param Entity\RoundImpl $modelRound
     * @return RoundIterator
     * @throws RDException
     */
    public function restore($modelRound){
        //echo 'restore model roind' . var_dump($modelRound);
        $q = 'SELECT * from team10.round WHERE 1=1 ';
        if($modelRound != NULL) {
            if ($modelRound->getNumber() != NULL) {
                $q .= ' AND number = ' . $modelRound->getNumber();
            }
            if ($modelRound->getId() != -1) {
                $q .= ' AND round_id = ' . $modelRound->getId();
            }
            if($modelRound->getLeague() != null){
                $q .= " AND league_id = " . $modelRound->getLeague()->getId();
            }
        }

        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            //echo " round manager line 104" .var_dump($resultSet);
            return new RoundIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring round model');
        }
    }

    /**
     * Returns match.
     * 
     * @param $round to restore
     * @return MatchIterator containing the match
     * @throws RDException
     */
    public function restoreMatches($round){
        if($round == NULL || !$round->isPersistent()) {
            throw new RDException('Round is not persistent');
        }

        $q = 'SELECT * FROM '. DB_NAME . '.match WHERE round_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $roundId = $round->getId();
        $stmt->bindParam(1, $roundId, \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return one result since there is only 1
            return new MatchIterator($resultSet, $this->objLayer);

        }
        else{
            throw new RDException('Error restoring matches');
        }
    }

    /**
     * Deletes round.
     * 
     * @param Entity\RoundImpl $round to delete
     * @throws RDException
     */
    public function delete($round){
        if($round->getId() == -1){
            //if round isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM round WHERE round_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $roundId = $round->getId();
        $stmt->bindParam(1, $roundId, \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'round deleted successfully';
        }
        else{
            throw new RDException('Deletion of round unsuccessful');
        }
    }
}