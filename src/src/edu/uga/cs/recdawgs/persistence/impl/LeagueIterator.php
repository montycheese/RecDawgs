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
     * Creates a League  Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of league data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with leagueobjects
         *
         * $name = null, $leagueRules = null, $matchRules,
         $isIndoor = null, $minTeams = null, $maxTeams = null, $minPlayers = null, $maxPlayers = null
         */
        for($i=0; $i < count($resultSet); $i++){
            $league = null;
            try {
                $league = $objLayer->createLeague(
                    $resultSet['name'],
                    $resultSet['league_rules'],
                    $resultSet['match_rules'],
                    $resultSet['is_indoor'],
                    intval($resultSet['min_teams']),
                    intval($resultSet['max_teams']),
                    intval($resultSet['min_players']),
                    intval($resultSet['max_players'])
                );
                $league.setId($resultSet['$league_id']);
                array_push($this->array, $league);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}