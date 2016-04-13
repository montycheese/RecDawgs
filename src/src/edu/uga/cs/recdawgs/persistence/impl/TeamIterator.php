<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 11:17
 */
namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\entity\impl\LeagueImpl  as LeagueImpl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\entity\impl\StudentImpl as StudentImpl;
use edu\uga\cs\recdawgs\RDException;

class TeamIterator extends PersistenceIterator{
    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a Team  Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of team data returned from a DB query
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
            $team = null;
            $student = null;
            $league = null;
            try {
                //create student obj who is team captain
                $student = $objLayer->createStudent();
                $student->setId(intval($resultSet[$i]['captain_id']));

                //use ID to get specific student
                $studentIter = $objLayer->findStudent($student); //->current();
                //echo 'studnet iter: ' . var_dump($studentIter);
                $captain = $studentIter->current();

                //create league obj that the team belongs to
                //$league = new LeagueImpl();
                $league = $objLayer->createLeague();
                $league->setId(intval($resultSet[$i]['league_id']));
                $league = $objLayer->findLeague($league)->current();

                $team = $objLayer->createTeam(
                    $resultSet[$i]['name'],
                    $captain,
                    $league
                );
                $team->setId($resultSet[$i]['$team_id']);
                array_push($this->array, $team);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }

}