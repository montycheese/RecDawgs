<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class MatchIterator extends PersistenceIterator{
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a Match Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of match data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with Match objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $match = null;
            try {
                $match = $objLayer->createMatch(
                    $resultSet[$i]['home_points'],
                    $resultSet[$i]['away_points'],
                    $resultSet[$i]['date'],
                    $resultSet[$i]['is_completed'],
                    $resultSet[$i]['home_team_id'],
                    $resultSet[$i]['away_team_id']
                );
                $match->setId($resultSet[$i]['match_id']);

                array_push($this->array, $match);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }

}