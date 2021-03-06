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
                /*$round = $objLayer->createRound(
                    $resultSet[$i]['number']
                );*/
                $round = $objLayer->createRound();
                $round->setNumber($resultSet[$i]['number']);
                $round->setId($resultSet[$i]['round_id']);

                //find the league that is assoc with this round
                $modelLeague = $this->objLayer->createLeague();
                $modelLeague->setId($resultSet[$i]['league_id']);
                $league = $this->objLayer->findLeague($modelLeague)->current();
                //set the league into this round
                $round->setLeague($league);
                array_push($this->array, $round);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}