<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 12:25
 */
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class RoundIterator extends PersistenceIterator {
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a round Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of round data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with round objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $round = null;
            try {
                $round = $objLayer->createRound(
                    $resultSet['number']
                );
                $round.setId($resultSet['round_id']);
                array_push($this->array, $round);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}