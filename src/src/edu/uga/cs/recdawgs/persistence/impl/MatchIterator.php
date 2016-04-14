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
                $homeTeam = $objLayer->findTeam($homeTeam)->current();
                $league = $objLayer->restoreTeamParticipatesInLeague($homeTeam);

                $homeTeam->setParticipatesInLeague($league);


                $awayTeam = $objLayer->createTeam();
                $awayTeam->setId( $resultSet[$i]['away_team_id']);
                $awayTeam = $objLayer->findTeam($awayTeam)->current();
                $league2= $objLayer->restoreTeamParticipatesInLeague($awayTeam);
                $awayTeam->setParticipatesInLeague($league2);

                //create match obj to get sports venue from
                $match = $objLayer->createMatch();
                $match->setId($resultSet[$i]['match_id']);
                $sportsVenue = $objLayer->restoreMatchSportsVenue($match);
                /*$match = $objLayer->createMatch(
                    $resultSet[$i]['home_points'],
                    $resultSet[$i]['away_points'],
                    $resultSet[$i]['date'],
                    $resultSet[$i]['is_completed'],
                    $homeTeam,
                    $awayTeam
                );*/
                //$match = $objLayer->createMatch();
                $match->setHomePoints($resultSet[$i]['home_points']);
                $match->setAwayPoints($resultSet[$i]['away_points']);
                $match->setDate($resultSet[$i]['date']);
                $match->setIsCompleted($resultSet[$i]['is_completed']);
                $match->setHomeTeam($homeTeam);
                $match->setAwayTeam($awayTeam);
                $match->setSportsVenue($sportsVenue);
                //$match->setId($resultSet[$i]['match_id']);

                array_push($this->array, $match);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
       // echo 'match iterator' .  var_dump($this->array);
    }

}