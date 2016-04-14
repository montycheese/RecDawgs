<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 12:48
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class LeagueIterator extends PersistenceIterator{
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a League Iterator.
     *
     * @param $resultSet array Associative array containing an array of rows of league data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with leagueobjects
         *
         *
         */
        for($i=0; $i < count($resultSet); $i++){
            $league = null;
            try {
                $league = $objLayer->createLeague(
                    $resultSet[$i]['name'],
                    $resultSet[$i]['league_rules'],
                    $resultSet[$i]['match_rules'],
                    $resultSet[$i]['is_indoor'],
                    intval($resultSet[$i]['min_teams']),
                    intval($resultSet[$i]['max_teams']),
                    intval($resultSet[$i]['min_players']),
                    intval($resultSet[$i]['max_players'])
                );
                $league->setId(intval($resultSet[$i]['league_id']));
                array_push($this->array, $league);
            }
            catch(RDException $rde){
                echo $rde->getMessage();
            }

        }
    }
}