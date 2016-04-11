<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/11/16
 * Time: 09:22
 */

namespace edu\uga\cs\recdawgs\tests;

use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;

class ReadTest extends \PHPUnit_Framework_TestCase {
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
    public function testReadAdmin(){
        echo 'Admin objects:\n ';
        $iter = $this->objLayer->findAdministrator(null);
        $i=0;
        while($iter->hasNext()){
            $admin = $iter->current();
           echo 'Admin id: ' . strval($admin->getId()) .' '. $admin->getFirstName() . ' '  . $admin->getLastName();
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }
    
    public function testReadStudent(){
        echo 'Student objects:\n ';
        $iter = $this->objLayer->findStudent(null);
        $i=0;
        while($iter->hasNext()){
            $student = $iter->current();
            echo 'student id: ' . strval($student->getId()) .' '. $student->getFirstName() . ' '  . $student->getLastName();
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }

    /**
     * Prints out every team obj in the persistence db
     */
    public function testReadTeam(){
        echo 'Team objects:\n ';
        $iter = $this->objLayer->findTeam(null);
        $i=0;
        //loop through each team
        while($iter->hasNext()){
            $team = $iter->current();
            echo 'team id: ' . strval($team->getId()) .' name:'. $team->getName() . ' league:'  . $team->getParticipatesInLeague() .
            ' captain: ' . $team->getCaptain()->getFirstName() . ' ' . $team->getCaptain()->getLastName();
            echo 'Members of this team: ';
            $memberIter = $this->objLayer->restoreStudentMemberOfTeam(null, $team);
            //loop through each member
            while($memberIter->hasNext()){
                $student = $memberIter->current();
                echo 'student id: ' . strval($student->getId()) .' '. $student->getFirstName() . ' '  . $student->getLastName();
                $memberIter->next();
            }
            echo '---\n';
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }

    /**
     * Reads and outputs to string every league objct in the data base and all of its additional constitutient data.
     */
    public function testReadLeague(){
        echo 'League objects:\n ';
        $iter = $this->objLayer->findLeague(null);
        $i=0;
        //loop through each league
        while($iter->hasNext()){
            //echo league info
            $league = $iter->current();
            echo 'league id: ' . strval($league->getId()) .' name:'. $league->getName() . ' is indoor: '  . $league->getIsIndoor() .
                ' min # teams: ' . strval($league->getMinTeams()) . ' max # teams' . strval($league->getMaxTeams()) .
                ' min # members:'. strval($league->getMinMembers()) . ' max # members'  . strval($league->getMaxMembers()) .
                ' league rules: ' . $league->getLeagueRules() . ' match rules' . $league->getMatchRules() .
            'league winner: ' . $league->getWinnerOfLeague();
            echo 'Teams of this League: ';
            $teamIter = $this->objLayer->restoreTeamParticipatesInLeague(null, $league);

            //loop through each team in this league
            while($teamIter->hasNext()){
                $team = $teamIter->current();
                echo 'team id: ' . strval($team->getId()) .' '. $team->getName();
                $teamIter->next();
            }

            //loop through each sports venue in this league
            echo 'Sports venues used by this League: ';
            $venueIter = $this->objLayer->restoreLeagueSportsVenue($league, null);
            while($venueIter->hasNext()){
                $venue = $venueIter->current();
                echo 'venue id: ' . strval($venue->getId()) .' '. $venue->getName();
                $venueIter->next();
            }

            //loop through each round in this league
            echo 'Rounds in this League: ';
            $roundIter = $this->objLayer->restoreLeagueRound($league);
            while($roundIter->hasNext()){
                $round = $roundIter->current();
                echo 'Round id: ' . strval($round->getId()) .' Round number: '. $round->getNumber();
                $roundIter->next();
            }

            echo '---\n';
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }

    /**
     * Prints out every match obj in the persistence db
     */
    public function testReadMatch(){
        echo 'Match objects:\n ';
        $iter = $this->objLayer->findMatch(null);
        $i=0;
        //loop through each match
        while($iter->hasNext()){
            $match = $iter->current();
            echo 'match id: ' . strval($match->getId()) .' Hometeam: '. $match->getHomeTeam()->getName() . ' Away team: '  . $match->getAwayTeam()->getName() .
                ' match date: ' . $match->getDate() . ' venue: ' . $match->getSportsVenue()->getName();
            $played = $match->getIsCompleted();
            if($played){
                echo 'game played, home team points: ' . strval($match->getHomePoints()) . ' away team points: ' . strval($match->getAwayPoints());
            }
            else{
                echo 'game not yet played';
            }
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }

    /**
     * Prints out every sports venue obj in the persistence db
     */
    public function testReadSportsVenue(){
        //TODO
        echo 'venue objects:\n ';
        $i=0;
        echo strval($i) . ' total objects';
    }

    /**
     * Prints out every score report obj in the persistence db
     */
    public function testReadScoreReport(){
        //TODO
        echo 'score report objects:\n ';
        $i=0;
        echo strval($i) . ' total objects';
    }

    /**
     * Prints out every round obj in the persistence db
     */
    public function testReadRound(){
        //TODO
        echo 'round objects:\n ';
        $i=0;
        echo strval($i) . ' total objects';
    }

}
