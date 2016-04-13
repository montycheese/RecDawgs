<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 11:17
 */
namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\entity\impl\UserImpl as UserImpl;
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
                $student = new UserImpl();
                $student->setId($resultSet[$i]['captain_id']);
                //use ID to get specific student
                $captain = $objLayer->findStudent($student);

                //create league obj that the team belongs to
                $league = new LeagueImpl();
                $league->setId($resultSet[$i]['league_id']);
                $league = $objLayer->findLeague($league);

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