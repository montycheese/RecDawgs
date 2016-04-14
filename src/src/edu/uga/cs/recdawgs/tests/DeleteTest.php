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

    /**
     * DeleteTest constructor.
     */
    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    public function testDeleteScoreReport(){
        echo "\nScore report objects to Delete: \n";
        $iter = $this->objLayer->findScoreReport(null);
        $i=0;
        //loop
        while($iter->current()){
            $report = $iter->current();
            //echo var_dump($report);
            echo "
            Report id: {$report->getId()}
            Report home points: {$report->getHomePoints()}
            Report away points: {$report->getAwayPoints()}
            Report submit date: {$report->getDate()}
            Report match's id: {$report->getMatch()->getId()}
            Report submitted by user: {$report->getStudent()->getFirstName()} {$report->getStudent()->getLastName()}
            ";

            echo "\nDeleting report.\n";
            $this->objLayer->deleteScoreReport($report);
            $iter->next();
            ++$i;
        }
        echo "\nAll Score report objects deleted successfully.\n";
    }


    /**
     * Tests deleting match from db.
*/
    public function testDeleteMatch() {
        echo "
        Match objects to Delete: \n";
        $iter = $this->objLayer->findMatch(null);
        while($iter->current()){
            $match = $iter->current();
            echo "Match id: {$match->getId()}
            Match home points: {$match->getHomePoints()}
            Match away points: {$match->getAwayPoints()}
            Match date: {$match->getDate()};
            Match isCompleted: {$match->getIsCompleted()}
            Match home team: {$match->getHomeTeam()->getName()}
            Match away team: {$match->getAwayTeam()->getName()}
            Match's sports venue: {$match->getSportsVenue()->getName()}
            Match's round number: {$match->getRound()->getNumber()}
            ";

            echo "\nDeleting match.\n";

            try {
                $this->objLayer->deleteMatch($match);
                echo "\nDeletion successful.\n";
            }
            catch(RDException $r){
                echo "\nError deleting Match.\n";
            }

            $iter->next();
        }
        echo "\nAll Match objects deleted successfully.\n";
    }
    
    /**
     * Tests deleting all members of a team.
     */

    public function testDeleteMembersOfTeam(){
        echo "\nTeam member objects to delete:\n";
        $iter = $this->objLayer->findTeam(null);
        //echo 'team dump: ' . var_dump($iter);
        while($iter->current()){
            $_team = $iter->current();
            //echo 'team dump: ' . var_dump($_team);
            echo "Team id: {$_team->getId()}
            Team name: {$_team->getName()}
            Team captain: {$_team->getCaptain()->getFirstName()} {$_team->getCaptain()->getLastName()}
            Team participates in this league: {$_team->getParticipatesinLeague()}
            Team has won in this league: {$_team->getWinnerOfLeague()}
            ";
            //  try {
            //get member iter
            
            echo "\nDeleting all members of this team.\n";
            
            $teamMemberIter = $this->objLayer->restoreStudentMemberOfTeam(null,$_team);

            //loop thru all members of this team
            while($teamMemberIter->current()){

                $teamMember = $teamMemberIter->current();
                //we'll only delete the team if they are not a captain, otherwise the team won't exist.
                if($teamMember->getId() != $_team->getCaptain()->getId()){
                    $this->objLayer->deleteStudentMemberOfTeam($teamMember, $_team);
                    echo "\n{$teamMember->getFirstName()} {$teamMember->getLastName()} removed from {$_team->getName()} successfully.\n";
                }
                $teamMemberIter->next();
            }

            $iter->next();
        }
        echo "\nAll team members deleted successfully.\n";
    }

    /**
     * Tests deleting a team from a league.
     */ 

    public function testDeleteTeamFromLeague(){
        echo "\nLeague Objects: \n";
        $iter = $this->objLayer->findLeague(null);
        while($iter->current()){
            $league = $iter->current();
            echo "League id: {$league->getId()}
            League name: {$league->getName()}
            League is indoor?: {$league->getIsIndoor()}
            League min # teams: {$league->getMinTeams()}
            League max # teams: {$league->getMaxTeams()}
            League min # members: {$league->getMinMembers()}
            League max # members: {$league->getMaxMembers()}
            League rules: {$league->getLeagueRules()}
            Match name: {$league->getMatchRules()}
            League Winner: {$league->getWinnerOfLeague()}";
            echo "\nRemoving teams from this league\n";

            $teamIter = $this->objLayer->restoreTeamParticipatesInLeague(null, $league);

            //loop through teams in this league
            while($teamIter->current()){
                $team = $teamIter->current();
                $this->objLayer->deleteTeamParticipatesInLeague($team, $league);
                echo "\nTeam: {$team->getName()} removed from this league.\n";
                $teamIter->next();
            }

            $iter->next();
        }
    }

    /**
     * Remove the relationship between a sports venue and league
     */
    public function testDeleteSportsVenueFromLeague(){
        echo "\nLeague Objects: \n";
        $iter = $this->objLayer->findLeague(null);
        while($iter->current()){
            $league = $iter->current();
            echo "League id: {$league->getId()}
            League name: {$league->getName()}
            League is indoor?: {$league->getIsIndoor()}
            League min # teams: {$league->getMinTeams()}
            League max # teams: {$league->getMaxTeams()}
            League min # members: {$league->getMinMembers()}
            League max # members: {$league->getMaxMembers()}
            League rules: {$league->getLeagueRules()}
            Match name: {$league->getMatchRules()}
            ";
            echo "\nRemoving Sports venues from this league\n";

            $venueIter = $this->objLayer->restoreLeagueSportsVenue($league,null);

            //loop through venues in this league
            while($venueIter->current()){
                $venue = $venueIter->current();
                $this->objLayer->deleteLeagueSportsVenue($league, $venue);
                echo "\nVenue: {$venue->getName()} removed from this league.\n";
                $venueIter->next();
            }

            $iter->next();
        }
    }

    /**
     * Tests deleting team from db.
     */
    public function testDeleteTeam() {
        echo "\nTeams to delete: \n";
        $iter = $this->objLayer->findTeam(null);
        
        while($iter->current()){
            $team = $iter->current();
            echo "Team id: {$team->getId()}
            Team name: {$team->getName()}
            Team captain: {$team->getCaptain()->getFirstName()} {$team->getCaptain()->getLastName()}
            ";

            try {
                $this->objLayer->deleteTeam($team);
            }
            catch(RDException $r){
                echo "\nError deleting team object.\n";
            }

            $iter->next();
        }
        
        echo "\nAll teams deleted successfully.\n";
    }

    /**
     * Reads all admin objs from persistence db
     */
    public function testDeleteAdmin(){
        echo "\nAdmin objects to delete:\n";
        $iter = $this->objLayer->findAdministrator(null);
        while($iter->current()){
            $admin = $iter->current();
            echo "Admin id: {$admin->getId()}
            First name: {$admin->getFirstName()}
            Last name: {$admin->getLastName()}
            Username: {$admin->getUserName()}
            Password: {$admin->getPassword()}
            Email address: {$admin->getEmailAddress()}
            ";
            
            try {
                $this->objLayer->deleteAdministrator($admin);
            }
            catch(RDException $r){
                echo "\nError deleting administator object.\n";
            }
            $iter->next();
        }
        echo "\nAll admin objects deleted successfully.\n";
    }

    /**
     * Tests deleting student from db.
     */
     
    public function testDeleteStudent(){
        echo "
        Student objects:";
        $iter = $this->objLayer->findStudent(null);
        while($iter->current()){
            $student = $iter->current();
            echo 'student id: ' . strval($student->getId()) .' firstName:'. strval($student->getFirstName()) . ' lastName:'  . strval($student->getLastName());
            echo '
            deleting this student

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

    /**
     * Tests deleting league from db.
     */
    public function testDeleteLeague() {
        echo '
        League objects:

         ';
        $iter = $this->objLayer->findLeague(null);
        while($iter->current()){
            $league = $iter->current();
            echo 'league id: ' . strval($league->getId()) .' name:'. $league->getName() . ' is indoor: '  . $league->getIsIndoor() .
                ' min # teams: ' . strval($league->getMinTeams()) . ' max # teams' . strval($league->getMaxTeams()) .
                ' min # members:'. strval($league->getMinMembers()) . ' max # members'  . strval($league->getMaxMembers()) .
                '
                league rules:
                ' . strval($league->getLeagueRules()) . '
                match rules:
                ' . strval($league->getMatchRules()) .
                'league winner: ' . $league->getWinnerOfLeague();
            echo '
            deleting this league

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

    /**
     * Tests deleting sports venue from db.
     */

    public function testDeleteSportsVenue() {
        echo '
        Venue objects:

         ';
        $iter = $this->objLayer->findSportsVenue(null);
        while($iter->current()){
            $venue = $iter->current();
            echo 'Venue name: ' . strval($venue->getName()) .'

             Address: '. strval($venue->getAddress() . '
                Is Indoor? ' . ($venue->getIsIndoor()) ? 'Yes' : 'No');

            echo '
            deleting this venue

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

    /**
     * Tests deleting round from db.
     */

    public function testDeleteRound() {
        echo '
        Round objects:

         ';
        $iter = $this->objLayer->findRound(null);
        while($iter->current()){
            $round = $iter->current();
            echo 'Round number: ' . strval($round->getNumber());

            echo '
            deleting this round

            ';

            try {
                $this->objLayer->deleteRound($round);
                echo 'Deletion successful

                ';
            }
            catch(RDException $r){
                echo 'Error deleting round obj';
            }

            $iter->next();
        }
    }


}
