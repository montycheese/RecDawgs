<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/7/16
 * Time: 11:45
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class ScoreReportManager {
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

    public function save($report){
        if($report->isPersistent()){
            //update
            $q = "UPDATE score_report
                set home_points = ?,
              away_points = ?,
              score_report.date = ?,
              match_id = ?,
              student_id = ?
              WHERE sports_venue_id = ?;";

            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $report->getHomePoints(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $report->getAwayPoints(), \PDO::PARAM_INT);
            $stmt->bindParam(3, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(4, $report->getId(), \PDO::PARAM_INT);
            $stmt->bindParam(5, $isIndoor, \PDO::PARAM_INT);
            $stmt->bindParam(6, $report->getId(), \PDO::PARAM_INT);

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
            $stmt->bindParam(1, $report->getName(), \PDO::PARAM_STR);
            $stmt->bindParam(2, $report->getAddress(), \PDO::PARAM_STR);
            $isIndoor = ($report->getIsIndoor() ? 1 : 0);
            $stmt->bindParam(3, $isIndoor, \PDO::PARAM_INT);

            if($stmt->execute()){
                $report->setId($this->dbConnection->lastInsertId());
                echo 'venue created successfully';
            }
            else{
                throw new RDException('venue creating match');
            }
        }
    }

    public function restore($modelReport){

    }
    public function delete($report){

    }
}