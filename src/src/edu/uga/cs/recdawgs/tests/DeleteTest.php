<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/11/16
 * Time: 17:17
 */

namespace edu\uga\cs\recdawgs\tests;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;
use edu\uga\cs\recdawgs\RDException;


spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});

class DeleteTest extends \PHPUnit_Framework_TestCase {
    private $persistenceLayer = null;
    private $objLayer = null;

    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    /**
     * Reads all admin objs from persistence db
     */
    public function testDeleteAdmin(){
        echo 'Querying an Admin object:\n ';
        $iter = $this->objLayer->findAdministrator(null);
        while($iter->current()){
            $admin = $iter->current();
            echo 'userid: ' . strval($admin->getId()) .' firstname: '. $admin->getFirstName() . ' lastname: '  . $admin->getLastName();
            echo 'deleting this admin

            ';
            try {
                $this->objLayer->deleteAdministrator($admin);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting admin obj';
            }
            $iter->next();
        }
    }

    public function testDeleteStudent(){
        echo 'Student objects:\n ';
        $iter = $this->objLayer->findStudent(null);
        while($iter->current()){
            $student = $iter->current();
            echo 'student id: ' . strval($student->getId()) .' firstName:'. strval($student->getFirstName()) . ' lastName:'  . strval($student->getLastName());
            echo 'deleting this student

            ';
            try {
                $this->objLayer->deleteStudent($student);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting student obj';
            }

            $iter->next();
        }
    }

    public function testDeleteLeague() {
        echo 'League objects:\n ';
        $iter = $this->objLayer->findLeague(null);
        while($iter->current()){
            $league = $iter->current();
            echo 'league id: ' . strval($league->getId()) .' name:'. $league->getName() . ' is indoor: '  . $league->getIsIndoor() .
                ' min # teams: ' . strval($league->getMinTeams()) . ' max # teams' . strval($league->getMaxTeams()) .
                ' min # members:'. strval($league->getMinMembers()) . ' max # members'  . strval($league->getMaxMembers()) .
                ' league rules: ' . strval($league->getLeagueRules()) . ' match rules' . strval($league->getMatchRules()) .
                'league winner: ' . $league->getWinnerOfLeague();
            echo 'deleting this league

            ';
            try {
                $this->objLayer->deleteLeague($league);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting league obj';
            }

            $iter->next();
        }
    }

    public function testDeleteTeam() {
        echo 'Team objects:\n ';
        $iter = $this->objLayer->findTeam(null);
        while($iter->current()){
            $team = $iter->current();
            echo 'team id: ' . strval($team->getId()) .' name:'. $team->getName() . ' league:'  . $team->getParticipatesInLeague() .
            ' captain: ' . $team->getCaptain()->getFirstName() . ' ' . $team->getCaptain()->getLastName();
            
            echo 'deleting this team

            ';

            try {
                $this->objLayer->deleteTeam($team);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting team obj';
            }

            $iter->next();
        }
    }

    public function testDeleteScoreReport() {
        echo 'Report objects:\n ';
        $iter = $this->objLayer->findScoreReport(null);
        while($iter->current()){
            $report = $iter->current();
            echo 'Home points: ' . $report->getHomePoints() .' Away points: '. $report->getAwayPoints() .
                ' Date: '. strval($report->getDate()) . 'Match: '. strval($report->getMatch()) .
                ' Student who put in the score: '. strval($report->getStudent());
            
            echo 'deleting this report

            ';

            try {
                $this->objLayer->deleteScoreReport($report);
                echo 'Deletion successful';
            }
            catch(RDException $r){
                echo 'Error deleting report obj';
            }

            $iter->next();
        }
    }

    public function testDeleteSportsVenue() {
        echo 'Venue objects:\n ';
        $iter = $this->objLayer->findSportsVenue(null);
        while($iter->current()){
            $venue = $iter->current();
            echo 'Venue name: ' . strval($venue->getName()) .' Address: '. strval($venue->getAddress());
            
            echo 'deleting this venue

            ';

            try {
                $this->objLayer->deleteSportsVenue($venue);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting venue obj';
            }

            $iter->next();
        }
    }

    public function testDeleteRound() {
        echo 'Venue objects:\n ';
        $iter = $this->objLayer->findSportsVenue(null);
        while($iter->current()){
            $venue = $iter->current();
            echo 'Venue name: ' . strval($venue->getName()) .' Address: '. strval($venue->getAddress());
            
            echo 'deleting this venue

            ';

            try {
                $this->objLayer->deleteSportsVenue($venue);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting venue obj';
            }

            $iter->next();
        }
    }

    public function testDeleteMatch() {
        echo 'Match objects:


         ';
        $iter = $this->objLayer->findMatch(null);
        while($iter->current()){
            $match = $iter->current();
            echo 'match id: ' . strval($match->getId()) .' Hometeam: '. $match->getHomeTeam()->getName() . ' Away team: '  . $match->getAwayTeam()->getName() .
                ' match date: ' . $match->getDate() . ' venue: ' . $match->getSportsVenue()->getName();
            
            echo 'deleting this match

            ';

            try {
                $this->objLayer->deleteMatch($match);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting match obj';
            }

            $iter->next();
        }
    }
}
