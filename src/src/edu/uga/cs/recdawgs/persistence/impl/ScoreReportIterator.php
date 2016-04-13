<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 11:43
 */
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class ScoreReportIterator extends PersistenceIterator{
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a ScoreReport  Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of scorereport data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with score report objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $report = null;
            $match = null;
            $student = null;

            try {
                //create student obj who is team captain
                $student = new UserImpl();
                $student->setId($resultSet['student_id']);
                //use ID to get specific student
                $student = $objLayer->findStudent($student);

                //create match obj that the report belongs to
                $match = new MatchImpl();
                $match->setId($resultSet['match_id']);
                $match = $objLayer->findMatch($match);

                $report = $objLayer->createScoreReport(
                    $resultSet['home_points'],
                    $resultSet['away_points'],
                    $resultSet['date'],
                    $match,
                    $student
                );
                $report->setId($resultSet['$score_report_id']);
                array_push($this->array, $report);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}