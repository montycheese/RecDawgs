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
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }

    public function save($round){
        //TODO
        if($round->isPersistent()){
            //update
            $q = "UPDATE round
                set round.number = ?,
              league_id = ?,
              WHERE round_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $round->getNumber(), \PDO::PARAM_INT);
            //$stmt->bindParam(2, $round->getLeague()->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $round->getId(), \PDO::PARAM_INT);
            if($stmt->execute()){
                echo 'round created successfully';
            }
            else{
                throw new RDException('Error creating round');
            }
        }
        else{
            //TODO
            //insert
            //create Query
            $q = "INSERT INTO round (round.number, league_id) VALUES(?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $round->getNumber(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $round->getLeague()->getId(), \PDO::PARAM_INT);

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
     * @param Entity\RoundImpl $modelRound
     * @return RoundIterator
     * @throws RDException
     */
    public function restore($modelRound){
        $q = 'SELECT * from round WHERE 1=1 ';
        if($modelRound != NULL) {
            if ($attr = $modelRound->getNumber() != NULL) {
                $q .= ' AND number = ' . $attr;
            }
            if ($attr = $modelRound->getId() != NULL) {
                $q .= ' AND round_id = ' . $attr;
            }
         //   if ($attr = $modelRound->getLeague()->getId() != NULL){
           //     $q .= ' AND league_id = ' . $attr;
            //}
        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new RoundIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring round model');
        }
    }

    public function restoreMatches($round){
        if($round == NULL || !$round->isPersistent()) {
            throw new RDException('Round is not persistent');
        }

        $q = 'SELECT * FROM '. DB_NAME . '.match WHERE round_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $round->getId(), \PDO::PARAM_INT);
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
     * @param Entity\RoundImpl $round
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
        $stmt->bindParam(1, $round->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'round deleted successfully';
        }
        else{
            throw new RDException('Deletion of round unsuccessful');
        }
    }
}