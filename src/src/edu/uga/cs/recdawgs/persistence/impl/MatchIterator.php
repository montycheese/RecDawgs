<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class MatchIterator extends PersistenceIterator{
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a Match Iterator.
     *
     * @param $resultSet array Associative array containing an array of rows of match data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;
        //echo 'dump : ' . var_dump($resultSet);
        /**
         * Populate the iterator with Match objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $match = null;
            try {
                //create team obj
                $homeTeam = $objLayer->createTeam();
                $homeTeam->setId( $resultSet[$i]['home_team_id']);
                $league = $objLayer->restoreTeamParticipatesInLeague($homeTeam);

                $homeTeam->setParticipatesInLeague($league);


                $awayTeam = $objLayer->createTeam();
                $awayTeam->setId( $resultSet[$i]['away_team_id']);

                $league2= $objLayer->restoreTeamParticipatesInLeague($awayTeam);
                $awayTeam->setParticipatesInLeague($league2);

                $match = $objLayer->createMatch(
                    $resultSet[$i]['home_points'],
                    $resultSet[$i]['away_points'],
                    $resultSet[$i]['date'],
                    $resultSet[$i]['is_completed'],
                    $homeTeam,
                    $awayTeam
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