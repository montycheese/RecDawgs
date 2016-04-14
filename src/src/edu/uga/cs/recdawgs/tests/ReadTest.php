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

    /**
     * ReadTest constructor.
     */
    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    /**
     * Reads all admin objs from persistence db
     */
    public function testReadAdmin(){
        echo "\nAdmin objects:\n";
        $iter = $this->objLayer->findAdministrator(null);

        $i=0;
        //change is here
        while($iter->current()){
            $admin = $iter->current();
            echo "
            Admin id: {$admin->getId()}
            Admin name: {$admin->getFirstName()} {$admin->getLastName()}
            Admin email: {$admin->getEmailAddress()}
            Admin username: {$admin->getUserName()}
            Admin password: {$admin->getPassword()}
            ";
            $iter->next();
            ++$i;
        }
        echo "\n {$i} total Admin objects\n";

    }

    /**
     * Reads all student objs from persistence db
     */
    
    public function testReadStudent(){
        echo "\nStudent objects:\n";
        $iter = $this->objLayer->findStudent(null);
        $i=0;
        //echo 'var dump iter: ' . var_dump($iter);
        while($iter->current()){
            $student = $iter->current();
           echo "
            Student id: {$student->getId()}
            Student name: {$student->getFirstName()} {$student->getLastName()}
            Student email: {$student->getEmailAddress()}
            Student username: {$student->getUserName()}
            Student password: {$student->getPassword()}
            Student major: {$student->getMajor()}
            Student address: {$student->getAddress()}
            Student student id: {$student->getStudentId()}
            ";
            /*echo 'student id: ' . strval($student->getId()) .' firstname: '. $student->getFirstName() . ' lastname: '  . $student->getLastName() . '

            ';*/
            $iter->next();
            ++$i;
        }
        echo "\n {$i} total student objects\n";
    }

    /**
     * Prints out every team obj in the persistence db
     */
    public function testReadTeam(){
        echo "\nTeam objects:\n";
        $iter = $this->objLayer->findTeam(null);
        $i=0;

        //loop through each team
        while($iter->current()){
            $team = $iter->current();
            echo "
            Team id: {$team->getId()}
            Team name: {$team->getName()}
            Team's League: {$team->getParticipatesInLeague()->getName()}
            Team captain: {$team->getCaptain()->getFirstName()} {$team->getCaptain()->getLastName()}
            Winner of League?: {$team->getWinnerOfLeague()}
            ";


            /*echo 'team id: ' . strval($team->getId()) .' team name:'. $team->getName() . ' team\'s league:'  . $team->getParticipatesInLeague()->getName() .
            ' captain: ' . $team->getCaptain()->getFirstName() . ' ' . $team->getCaptain()->getLastName();*/

            echo "Members of this team:\n";
            $memberIter = $this->objLayer->restoreStudentMemberOfTeam(null, $team);
            //echo var_dump($memberIter);
            //loop through each member
            while($memberIter->current()){
                $student = $memberIter->current();
                echo "
                Student id: {$student->getId()}
                Student name: {$student->getFirstName()} {$student->getLastName()}
                Student email: {$student->getEmailAddress()}
                Student username: {$student->getUserName()}
                Student password: {$student->getPassword()}
                Student major: {$student->getMajor()}
                Student address: {$student->getAddress()}
                Student student id: {$student->getStudentId()}
                ";
                //echo 'student id: ' . strval($student->getId()) .' '. $student->getFirstName() . ' '  . $student->getLastName();
                $memberIter->next();
            }
            $iter->next();
            ++$i;
        }
        echo "\n{$i}  total Team objects\n";
    }

    /**
     * Reads and outputs to string every league object in the data base and all of its additional constitutient data.
     */
    public function testReadLeague(){
        echo "\nLeague objects:\n";
        $iter = $this->objLayer->findLeague(null);
        $i=0;
        //loop through each league
        while($iter->current()){
            //echo league info
            $league = $iter->current();
            echo "
            League id: {$league->getId()}
            League name: {$league->getName()}
            League is indoor?: {$league->getIsIndoor()}
            League min # teams: {$league->getMinTeams()}
            League max # teams: {$league->getMaxTeams()}
            League min # members: {$league->getMinMembers()}
            League max # members: {$league->getMaxMembers()}
            League rules: {$league->getLeagueRules()}
            Match name: {$league->getMatchRules()}
            League Winner: {$league->getWinnerOfLeague()}
            ";

            /*echo 'league id: ' . strval($league->getId()) .' name: '. $league->getName() . ' is indoor: '  . $league->getIsIndoor() .
                ' min # teams: ' . strval($league->getMinTeams()) . ' max # teams: ' . strval($league->getMaxTeams()) .
                ' min # members: '. strval($league->getMinMembers()) . ' max # members: '  . strval($league->getMaxMembers()) .
                ' league rules: ' . strval($league->getLeagueRules()) . ' match rules: ' . strval($league->getMatchRules()) .
            'league winner: ' . $league->getWinnerOfLeague();*/
            echo "Teams of this League:\n";

            $teamIter = $this->objLayer->restoreTeamParticipatesInLeague(null, $league);

            //loop through each team in this league
            while($teamIter->current()){
                $team = $teamIter->current();
                echo "
                Team id: {$team->getId()}
                Team name: {$team->getName()}
                Team captain: {$team->getCaptain()->getFirstName()} {$team->getCaptain()->getLastName()}
                Winner of League?: {$team->getWinnerOfLeague()}
                ";
                //echo 'team id: ' . strval($team->getId()) .' team name: '. $team->getName();
                $teamIter->next();
            }

            //loop through each sports venue in this league
            echo "
            Sports venues used by this League: \n";
            $venueIter = $this->objLayer->restoreLeagueSportsVenue($league, null);
            //var_dump($venueIter);
            while($venueIter->current()){
                $venue = $venueIter->current();
                echo "
                Venue id: {$venue->getId()}
                Venue name: {$venue->getName()}
                Venue address: {$venue->getAddress()}
                Is Indoor?: {$venue->getIsIndoor()}
                ";
                //echo 'venue id: ' . strval($venue->getId()) .' '. $venue->getName();
                $venueIter->next();
            }

            //loop through each round in this league
            echo "
            Rounds in this League:\n";
            $roundIter = $this->objLayer->restoreLeagueRound($league);
            while($roundIter->current()){
                $round = $roundIter->current();
                echo "
                Round id: {$round->getId()}
                Round number: {$round->getNumber()}
                ";
                //Belong to league: {$round->getLeague()->getName()}
                //";
                //echo 'Round id: ' . strval($round->getId()) .' Round number: '. $round->getNumber();
                $roundIter->next();
            }


            $iter->next();
            ++$i;
        }
        echo "\n{$i} total league objects\n";
    }

        /**
         * Prints out every match obj in the persistence db
         */
        public function testReadMatch(){
            echo "\nMatch objects:\n";
            $iter = $this->objLayer->findMatch(null);
            $i=0;
            //echo var_dump($iter);
            //loop through each match
            while($iter->current()){
                $match = $iter->current();

                /*if ($match->getHomeTeam() != null && $match->getAwayTeam() != null && $match->getSportsVenue() != null) {
                    echo 'match id: ' . strval($match->getId()) . ' Hometeam: ' . $match->getHomeTeam()->getName() . ' Away team: ' . $match->getAwayTeam()->getName() .
                        ' match date: ' . $match->getDate() . ' venue: ' . $match->getSportsVenue()->getName();
                }*/
                echo "
                Match id: {$match->getId()}
                Match hometeam: {$match->getHomeTeam()->getName()}
                Match awayteam: {$match->getAwayTeam()->getName()}
                Match date: {$match->getDate()}
                Match venue: {$match->getSportsVenue()->getName()}
                ";
                $played = $match->getIsCompleted();
                if($played){
                    echo "game played, home team points: {$match->getHomePoints()} away team points: {$match->getAwayPoints()}\n";
                }
                else{
                    echo "game not yet played\n";
                }
                $iter->next();
                ++$i;
            }
        echo "\n{$i} total match objects\n";
    }

    /**
     * Prints out every sports venue obj in the persistence db
     */
    public function testReadSportsVenue(){
        echo "\nSports Venue objects:\n";

        ;
        $iter = $this->objLayer->findSportsVenue(null);
        $i=0;
        //loop
        while($iter->current()){
            $venue = $iter->current();
            echo "
            Venue id: {$venue->getId()}
            Venue name: {$venue->getName()}
            Venue address: {$venue->getAddress()}
            ";
            //echo 'Venue name: ' . strval($venue->getName()) .' Address: '. strval($venue->getAddress());
            $indoor = $venue->getIsIndoor();
            if($indoor){
                echo "Allowed activity type: Indoor\n";
            }
            else{
                echo "Allowed activity type: Outdoor\n9";
            }
            $iter->next();
            ++$i;
        }
        echo "\n {$i} total sports venue objects\n";
    }

    /**
     * Prints out every round obj in the persistence db
     */
    public function testReadRound(){
        echo "\nRound objects\n";
        $iter = $this->objLayer->findRound(null);
        $i=0;
        //loop
        while($iter->current()){
            $round = $iter->current();
            echo "
            Round id: {$round->getId()}
            Round number: {$round->getNumber()}
            Belongs to league: {$round->getLeague()->getName()}
            ";
            //echo 'Number of round: ' . $round->getNumber() .' League: '. $round->getLeague();
            $iter->next();
            ++$i;
        }
        echo "\n{$i} total Round objects\n";
    }

    public function testReadScoreReport(){
        echo "\nScore report objects\n";
        $iter = $this->objLayer->findScoreReport(null);
        $i=0;
        //loop
        while($iter->current()){
            $report = $iter->current();
            echo "
            Report id: {$report->getId()}
            Report home points: {$report->getHomePoints()}
            Report away points: {$report->getAwayPoints()}
            Report submit date: {$report->getDate()}
            Report match's id: {$report->getMatch()->getId()}
            Report submitted by user: {$report->getStudent()->getFirstName()} {$report->getStudent()->getLastName()}
            ";
            //echo 'Number of round: ' . $round->getNumber() .' League: '. $round->getLeague();
            $iter->next();
            ++$i;
        }
        echo "\n{$i} total Score report objects\n";
    }

}
