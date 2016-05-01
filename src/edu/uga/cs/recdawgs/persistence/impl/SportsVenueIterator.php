<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 11:14
 */
namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class SportsVenueIterator extends PersistenceIterator {
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a sports venue Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of sports venue data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with sports venue objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $venue = null;
            try {
                $venue = $objLayer->createSportsVenue(
                    $resultSet[$i]['name'],
                    $resultSet[$i]['address'],
                    $resultSet[$i]['is_indoor']
                );
                $venue->setId($resultSet[$i]['sports_venue_id']);
                array_push($this->array, $venue);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}