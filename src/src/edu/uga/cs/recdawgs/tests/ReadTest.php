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

//autoload imports
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});


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
        echo 'Admin objects:

        ';
        $iter = $this->objLayer->findAdministrator(null);

        $i=0;
        //change is here
        while($iter->current()){
            $admin = $iter->current();
           echo 'Admin id: ' . strval($admin->getId()) .' '. $admin->getFirstName() . ' '  . $admin->getLastName() . '

           ';
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total admin objects

        ';
    }
    
    public function testReadStudent(){
        echo 'Student objects:

         ';
        $iter = $this->objLayer->findStudent(null);
        $i=0;
        //echo 'var dump iter: ' . var_dump($iter);
        while($iter->current()){
            $student = $iter->current();
            echo 'student id: ' . strval($student->getId()) .' firstname: '. $student->getFirstName() . ' lastname: '  . $student->getLastName() . '

            ';
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total student objects

        ';
    }

    /**
     * Prints out every team obj in the persistence db
     */
    public function testReadTeam(){
        echo 'Team objects:

        ';
        $iter = $this->objLayer->findTeam(null);
        $i=0;
        //loop through each team
        while($iter->current()){
            $team = $iter->current();
            echo 'team id: ' . strval($team->getId()) .' name:'. strval($team->getName()) . ' league:'  . strval($team->getParticipatesInLeague()) .
            ' captain: ' . strval($team->getCaptain()->getFirstName()) . ' ' . strval($team->getCaptain()->getLastName());
            echo 'Members of this team:

            ';
            $memberIter = $this->objLayer->restoreStudentMemberOfTeam(null, $team);
            //loop through each member
            while($memberIter->current()){
                $student = $memberIter->current();
                echo 'student id: ' . strval($student->getId()) .' '. $student->getFirstName() . ' '  . $student->getLastName();
                $memberIter->next();
            }
            echo '

            ';
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }

    /**
     * Reads and outputs to string every league objct in the data base and all of its additional constitutient data.
     */
    public function testReadLeague(){
        echo 'League objects:

         ';
        $iter = $this->objLayer->findLeague(null);
        $i=0;
        //loop through each league
        while($iter->current()){
            //echo league info
            $league = $iter->current();
            echo 'league id: ' . strval($league->getId()) .' name: '. $league->getName() . ' is indoor: '  . $league->getIsIndoor() .
                ' min # teams: ' . strval($league->getMinTeams()) . ' max # teams: ' . strval($league->getMaxTeams()) .
                ' min # members: '. strval($league->getMinMembers()) . ' max # members: '  . strval($league->getMaxMembers()) .
                ' league rules: ' . strval($league->getLeagueRules()) . ' match rules: ' . strval($league->getMatchRules()) .
            'league winner: ' . $league->getWinnerOfLeague();
            echo 'Teams of this League:

            ';
            $teamIter = $this->objLayer->restoreTeamParticipatesInLeague(null, $league);

            //loop through each team in this league
            while($teamIter->current()){
                $team = $teamIter->current();
                echo 'team id: ' . strval($team->getId()) .' team name: '. $team->getName();
                $teamIter->next();
            }

            //loop through each sports venue in this league
            echo 'Sports venues used by this League: ';
            $venueIter = $this->objLayer->restoreLeagueSportsVenue($league, null);
            while($venueIter->current()){
                $venue = $venueIter->current();
                echo 'venue id: ' . strval($venue->getId()) .' '. $venue->getName();
                $venueIter->next();
            }

            //loop through each round in this league
            echo '

            Rounds in this League: ';
            $roundIter = $this->objLayer->restoreLeagueRound($league);
            while($roundIter->current()){
                $round = $roundIter->current();
                echo 'Round id: ' . strval($round->getId()) .' Round number: '. $round->getNumber();
                $roundIter->next();
            }


            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total league objects

        ';
    }

    /**
     * Prints out every match obj in the persistence db
     */
    public function testReadMatch(){
        echo 'Match objects: ';
        $iter = $this->objLayer->findMatch(null);
        $i=0;
        //loop through each match
        while($iter->current()){
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
        echo strval($i) . ' total match objects

        ';
    }

    /**
     * Prints out every sports venue obj in the persistence db
     */
    public function testReadSportsVenue(){
        echo 'venue objects:\n ';
        $iter = $this->objLayer->findSportsVenue(null);
        $i=0;
        //loop
        while($iter->current()){
            $venue = $iter->current();
            echo 'Venue name: ' . strval($venue->getName()) .' Address: '. strval($venue->getAddress());
            $indoor = $venue->getIsIndoor();

            if($indoor){
                echo ' Allowed activity type: Indoor';
            }
            else{
                echo ' Allowed activity type: Outdoor';
            }
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total sports venue objects

        ';
    }

    /**
     * Prints out every score report obj in the persistence db
     */
    public function testReadScoreReport(){
        echo 'score report objects:\n ';
        $iter = $this->objLayer->findScoreReport(null);
        $i=0;
        //loop
        while($iter->current()){
            $report = $iter->current();
            echo 'Home points: ' . $report->getHomePoints() .' Away points: '. $report->getAwayPoints() .
                ' Date: '. strval($report->getDate()) . 'Match: '. strval($report->getMatch()) .
                ' Student who put in the score'. strval($report->getStudent());
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total Scorereport objects

        ';
    }

    /**
     * Prints out every round obj in the persistence db
     */
    public function testReadRound(){
        echo 'round objects:

         ';
        $iter = $this->objLayer->findRound(null);
        $i=0;
        //loop
        while($iter->current()){
            $round = $iter->current();
            echo 'Number of round: ' . $round->getNumber() .' League: '. $round->getLeague();
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total Round objects

        ';
    }

}
