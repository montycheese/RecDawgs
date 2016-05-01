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
                $captain = $studentIter->current();

                //create league obj that the team belongs to

                $league = $objLayer->createLeague();

                //$league->setId(intval($resultSet[$i]['league_id']));
                //$league = $objLayer->findLeague($league)->current();
                //echo var_dump($league);

                $team = $objLayer->createTeam();
                $team->setId($resultSet[$i]['team_id']);
                $team->setName($resultSet[$i]['name']);
                $team->setCaptain($captain);
                //get league
                $leagueIter = $objLayer->restoreTeamParticipatesInLeague($team, null);
                //die(var_dump($leagueIter));
                while($leagueIter->valid()){
                    $team->setParticipatesInLeague($leagueIter->current());
                    $leagueIter->next();
                }

                   // $resultSet[$i]['name'],
                    //$captain,
                    //$league
                //);


                array_push($this->array, $team);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
        //echo 'Team iterator lime 76' . var_dump($this->array);


    }

}