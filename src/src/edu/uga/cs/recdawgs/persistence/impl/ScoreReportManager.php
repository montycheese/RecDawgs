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
            $stmt->bindParam(3, $report->getDate());
            if($report->getMatch() != NULL) {
                $stmt->bindParam(4, $report->getMatch()->getId(), \PDO::PARAM_INT);
            }
            if($report->getStudent() != NULL) {
                $stmt->bindParam(5, $report->getStudent()->getId(), \PDO::PARAM_INT);
            }
            $stmt->bindParam(6, $report->getId(), \PDO::PARAM_INT);

            if($stmt->execute()){
                echo 'report created successfully';
            }
            else{
                throw new RDException('Error creating report');
            }
        }
        else{
            //insert
            //create Query
            $q = "INSERT INTO score_report (home_points, away_points, score_report.date, match_id, student_id)
                  VALUES(?, ?, ?, ?, ?);";
            //create prepared statement from query
            $stmt = $this->dbConnection->prepare($q);
            //bind parameters to prepared statement
            $stmt->bindParam(1, $report->getHomePoints(), \PDO::PARAM_INT);
            $stmt->bindParam(2, $report->getAwayPoints(), \PDO::PARAM_INT);
            $stmt->bindParam(3, $report->getDate());
            if($report->getMatch() != NULL) {
                $stmt->bindParam(4, $report->getMatch()->getId(), \PDO::PARAM_INT);
            }
            if($report->getStudent() != NULL) {
                $stmt->bindParam(5, $report->getStudent()->getId(), \PDO::PARAM_INT);
            }
            if($stmt->execute()){
                $report->setId($this->dbConnection->lastInsertId());
                echo 'report created successfully
                ';
            }
            else{
                throw new RDException('error creating report');
            }
        }
    }

    /**
     * @param Entity\ScoreReportImpl $modelReport
     * @return ScoreReportIterator
     * @throws RDException
     */
    public function restore($modelReport){
        $q = 'SELECT * from score_report WHERE 1=1 ';
        if($modelReport != NULL) {
            if ($modelReport->getHomePoints() != NULL) {
                $q .= ' AND home_points = ' . $modelReport->getHomePoints();
            }
            if ($modelReport->getAwayPoints() != NULL) {
                $q .= ' AND away_points = ' . $modelReport->getAwayPoints();
            }
            if ($modelReport->getDate() != NULL) {
                $q .= ' AND score_report.date = ' . $modelReport->getDate();
            }

            if ($modelReport->getId() != NULL){
                $q .= ' AND score_report_id = ' . $modelReport->getId();
            }
        }
        $stmt = $this->dbConnection->prepare($q . ';');
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new ScoreReportIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring report model');
        }
    }

    /**
     * @param Entity\ScoreReportImpl $report
     * @throws RDException
     */
    public function delete($report){
        if($report->getId() == -1){
            //if report isn't persistent, we are done
            return;
        }

        //Prepare mySQL query
        $q = 'DELETE FROM score_report WHERE score_report_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $report->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'report deleted successfully';
        }
        else{
            throw new RDException('Deletion of report unsuccessful');
        }
    }
}