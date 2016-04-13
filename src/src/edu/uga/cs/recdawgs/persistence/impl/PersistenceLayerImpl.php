<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\PersistenceLayer as PersistenceLayer;

class PersistenceLayerImpl implements PersistenceLayer{
    private $db = null;
    private $objLayer = null;

    /**
     * @param DbConnection $dbConnection
     * @param Object\ObjectLayerImpl $objLayer
     */
    function __construct($dbConnection, $objLayer)
    {
        $this->db = $dbConnection->db;
        $this->objLayer = $objLayer;
    }

    /**
     * Restore all Administrator objects that match attributes of the model Administrator.
     * @param Entity\UserImpl $modelAdministrator the model Administrator; if null is provided, all Administrator objects will be returned
     * @return AdministratorIterator Administrator Iterator of the located Administrator objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreAdministrator($modelAdministrator)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        return $mgmt->restoreAdministrator($modelAdministrator);
    }

    /**
     * Store a given Administrator object in the persistent data store.
     * If the Administrator object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param administrator Entity\UserImpl the Administrator to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeAdministrator($administrator)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        $mgmt->saveAdministrator($administrator);
    }

    /**
     * Delete a given Administrator object from the persistent data store.
     * @param Entity\UserImpl $administrator the Administrator to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function  deleteAdministrator($administrator)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        $mgmt->delete($administrator);
    }

    /**
     * Restore all Student objects that match attributes of the model Student.
     * @param modelStudent the model Student; if null is provided, all Student objects will be returned
     * @return an Iterator of the located Student objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function  restoreStudent($modelStudent)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        return $mgmt->restoreStudent($modelStudent);
    }

    /**
     * Store a given Student object in the persistent data store.
     * If the Student object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param student the Student to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeStudent($student)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        $mgmt->saveStudent($student);
    }

    /**
     * Delete a given Student object from the persistent data store.
     * @param student the Student to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteStudent($student)
    {
        $mgmt = new UserManager($this->db, $this->objLayer);
        $mgmt->delete($student);
    }

    /**
     * Restore all Match objects that match attributes of the model Match.
     * @param  Entity\MatchImpl $modelMatch the model Match; if null is provided, all Match objects will be returned
     * @return MatchIterator an Iterator of the located Match objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreMatch($modelMatch)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        return $mgmt->restore($modelMatch);
    }

    /**
     * Store a given Match object in the persistent data store.
     * If the Match object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param match the Match to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeMatch($match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->save($match);
    }

    /**
     * Delete a given Match object from the persistent data store.
     * @param match the Match to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteMatch($match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->delete($match);
    }

    /**
     * Restore all SportsVenue objects that match sportsVenue attributes of the model SportsVenue.
     * @param Entity\SportsVenueImpl $modelSportsVenue the model SportsVenue; if null is provided, all SportsVenue objects will be returned
     * @return SportsVenueIterator an Iterator of the located SportsVenue objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreSportsVenue($modelSportsVenue)
    {
        $mgmt = new SportsVenueManager($this->db, $this->objLayer);
        return $mgmt->restore($modelSportsVenue);
    }

    /**
     * Store a given SportsVenue object in the persistent data store.
     * If the SportsVenue object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param Entity\SportsVenueImpl $sportsVenue the SportsVenue to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeSportsVenue($sportsVenue)
    {
        $mgmt = new SportsVenueManager($this->db, $this->objLayer);
        $mgmt->save($sportsVenue);
    }

    /**
     * Delete a given SportsVenue object from the persistent data store.
     * @param sportsVenue the SportsVenue to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteSportsVenue($sportsVenue)
    {
        $mgmt = new SportsVenueManager($this->db, $this->objLayer);
        $mgmt->delete($sportsVenue);
    }

    /**
     * Restore all Team objects that match team attributes of the model Team.
     * @param modelTeam the model Team; if null is provided, all Team objects will be returned
     * @return an Iterator of the located Team objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeam($modelTeam)
    {
        $mgmt = new TeamManager($this->db, $this->objLayer);
        return $mgmt->restore($modelTeam);
    }

    /**
     * Store a given Team object in the persistent data store.
     * If the Team object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param team the Team to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeam($team)
    {
        $mgmt = new TeamManager($this->db, $this->objLayer);
        $mgmt->save($team);
    }

    /**
     * Delete a given Team object from the persistent data store.
     * @param team the Team to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeam($team)
    {
        $mgmt = new TeamManager($this->db, $this->objLayer);
        $mgmt->delete($team);
    }

    /**
     * Restore all League objects that match league attributes of the model League.
     * @param modelLeague the model League; if null is provided, all League objects will be returned
     * @return an Iterator of the located League objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreLeague($modelLeague)
    {
        $mgmt = new LeagueManager($this->db, $this->objLayer);
        return $mgmt->restore($modelLeague);
    }

    /**
     * Store a given League object in the persistent data store.
     * If the League object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param league the League to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeLeague($league)
    {
        $mgmt = new LeagueManager($this->db, $this->objLayer);
        $mgmt->save($league);
    }

    /**
     * Delete a given League object from the persistent data store.
     * @param league the League to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeague($league)
    {
        $mgmt = new LeagueManager($this->db, $this->objLayer);
        $mgmt->delete($league);
    }

    /**
     * Restore all ScoreReport objects that match modelScoreReport attributes of the model ScoreReport.
     * @param Entity\ScoreReportImpl $modelScoreReport the model ScoreReport; if null is provided, all ScoreReport objects will be returned
     * @return ScoreReportIterator an Iterator of the located ScoreReport objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreScoreReport($modelScoreReport)
    {
        $mgmt = new ScoreReportManager($this->db, $this->objLayer);
        return $mgmt->restore($modelScoreReport);
    }

    /**
     * Store a given ScoreReport object in the persistent data store.
     * If the ScoreReport object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param scoreReport the ScoreReport to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeScoreReport($scoreReport)
    {
        $mgmt = new ScoreReportManager($this->db, $this->objLayer);
        $mgmt->save($scoreReport);
    }

    /**
     * Delete a given ScoreReport object from the persistent data store.
     * @param Entity\ScoreReportImpl $scoreReport the ScoreReport to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteScoreReport($scoreReport)
    {
        $mgmt = new ScoreReportManager($this->db, $this->objLayer);
        $mgmt->delete($scoreReport);
    }

    /**
     * Restore all Round objects that match modelRound attributes of the model Round.
     * @param modelRound the model Round; if null is provided, all Round objects will be returned
     * @return an Iterator of the located Round objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreRound($modelRound)
    {
        $mgmt = new RoundManager($this->db, $this->objLayer);
        return $mgmt->restore($modelRound);
    }

    /**
     * Store a given Round object in the persistent data store.
     * If the Round object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param round the Round to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeRound($round)
    {
        $mgmt = new RoundManager($this->db, $this->objLayer);
        $mgmt->save($round);
    }

    /**
     * Delete a given Round object from the persistent data store.
     * @param round the Round to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteRound($round)
    {
        $mgmt = new RoundManager($this->db, $this->objLayer);
        $mgmt->delete($round);
    }

    /**
     * Store a link between a Student and a Team captained by the Student.
     * @param Entity\UserImpl $student the Student to be linked
     * @param Entity\TeamImpl $team the Team to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeStudentCaptainOfTeam($student, $team)
    {
        $mgmt = new TeamManager($this->db, $this->objLayer);
        $mgmt->storeStudentCaptainOf($student, $team);
    }

    /**
     * The operation of this function depends on which of the default parameters is not null
     *
     * Return the Student who is the captain a given Team.
     * @param team the Team
     * @return the Student who is the captain of the Team
     * @throws RDException in case an error occurred during the restore operation
     * OR
     * Return Teams captained by a given Student.
     * @param student the Student
     * @return an Iterator with all Teams captained by the Student
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreStudentCaptainOfTeam($team = null, $student = null)
    {
        $mgmt = null;
        //return student who is captain
       if ($team != null){
           $mgmt = new TeamManager($this->db, $this->objLayer);
           return $mgmt->restoreStudentCaptainOf($team);
       }
       //return team iterator
       else if($student != null){
           $mgmt = new UserManager($this->db, $this->objLayer);
           return  $mgmt->restoreTeamsCaptainedBy($student);
       }
       else{
            throw new RDException('Both parameters can not be null');
        }
    }

    /**
     * Delete a link between a Student and a Team captained by the Student.
     * @param student the Student
     * @param team the Team
     * @throws RDException in case an error occurred during the delete operation
     */
    public function  deleteStudentCaptainOfTeam($student, $team)
    {
        (new TeamManager($this->db, $this->objLayer))->deleteStudentCaptainOf($student, $team);
    }

    /**
     * Store a link between a Student and a Team of which the Student is a member.
     * @param student the Student to be linked
     * @param team the Team to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeStudentMemberOfTeam($student, $team)
    {
        (new TeamManager($this->db, $this->objLayer))->storeStudentMemberOf($student, $team);
    }

    /**
     * Returns either array of teams or array of students depending on which parameter is not null
     *
     *  * Return Teams of which a given Student is a member.
     * @param student the Student
     * @return an Iterator with all Teams in which the Student is a member
     * @throws RDException in case an error occurred during the restore operation
     *
     *
     * Return Students who are members of a given Team.
     * @param team the Team
     * @return an Iterator with all Students who are members of the team
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreStudentMemberOfTeam($team = null, $student = null)
    {
        //return iterator of students
        if ($team != null){
            return (new TeamManager($this->db, $this->objLayer))->restoreStudentMemberOf($team);
        }
        //return iterator of teams
        else if ($student != null){
            return (new UserManager($this->db, $this->objLayer))->restoreTeamsMemberOf($student);
        }
        else{
            throw new RDException('Both params can not be null');
        }
    }

    /**
     * Delete a link between a Student and a Team of which the Student is a member.
     * @param student the Student
     * @param team the Team
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteStudentMemberOfTeam($student, $team)
    {
        (new TeamManager($this->db, $this->objLayer))->deleteStudentMemberOf($student, $team);
    }

    /**
     * Store a link between a Team and a Match in which the team is the home team.
     * @param team the Team to be linked
     * @param match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function  storeTeamHomeTeamMatch($team, $match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->storeHomeTeam($team, $match);
    }

    /**
     *  /**
     * Return Matches in which a given Team is the home team.
     * @param team the Team
     * @return an Iterator with all Matches in which the Team is the home team
     * @throws RDException in case an error occurred during the restore operation
     *
     * Return the Team which is the home team in a given Match.
     * @param match the Match
     * @return the Team which is the home team in the Match
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeamHomeTeamMatch($match = null, $team = null)
    {
        //$team is set, return the match iterator
        if($team != null){
            return (new TeamManager($this->db, $this->objLayer))->restoreMatchesHome($team);
        }
        // else match is set, return the team
        else if ($match != null) {
            $mgmt = new MatchManager($this->db, $this->objLayer);
            return $mgmt->restoreHomeTeam($match);
        }
        else{
            throw new RDException('Error restoring: ' . (isset($match)) ? 'Team from match' : 'Matches from team');
        }

    }

    /**
     * Delete a link between a Team and a Match in which the team is the home team.
     * @param team the Team
     * @param match the Match
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamHomeTeamMatch($team, $match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->deleteHomeTeam($match);
    }

    /**
     * Store a link between a Team and a Match in which the team is the away team.
     * @param team the Team to be linked
     * @param match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamAwayTeamMatch($team, $match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->storeAwayTeam($team, $match);
    }

    /**
     * * Return Matches in which a given Team is the away team.
     * @param team the Team
     * @return an Iterator with all Matches in which the Team is the away team
     * @throws RDException in case an error occurred during the restore operation
     *
     * Return the Team which is the away team in a given Match.
     * @param match the Match
     * @return the Team which is the away team in the Match
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeamAwayTeamMatch($team = null,$match = null)
    {
        $mgmt = null;
        //return iterator of matches
        if( $team != null){
            return (new TeamManager($this->db, $this->objLayer))->restoreMatchesAway($team);
        }
        //match is not null return single team
        else if ($match != null){
            $mgmt = new MatchManager($this->db, $this->objLayer);
            return $mgmt->restoreAwayTeam($match);
        }
        else{
            throw new RDException('both params can not be null');
        }
    }

    /**
     * Delete a link between a Team and a Match in which the team is the away team.
     * @param team the Team
     * @param match the Match
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamAwayTeamMatch($team, $match)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->deleteAwayTeam($match);
    }

    /**
     * Store a link between a Team and a League in which the team participates.
     * @param Entity\TeamImpl $team the Team to be linked
     * @param Entity\LeagueImpl $league the League to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamParticipatesInLeague($team, $league)
    {
        (new TeamManager($this->db, $this->objLayer))->storeParticipatesIn($team, $league);
    }

    /**
     * Returns either a league or an iterator of teams based on which param is not null
     *
     * Return the League in which a given Team participates.
     * @param team the Team
     * @return the League in which the Team participates
     * @throws RDException in case an error occurred during the restore operation
     *
     *
     * Return the Teams which participate in a given League.
     * @param league the League
     * @return an Iterator with all Teams which participate in the League
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeamParticipatesInLeague($team = null,$league=null)
    {
        //return the league
        if($team != null){
            return (new TeamManager($this->db, $this->objLayer))->restoreParticipatesIn($team);
        }
        //return the teams in the league
        else if ($league != null){
            return (new LeagueManager($this->db,$this->objLayer ))->restoreParticipantsIn($league);
        }
        else{
            throw new RDException('Both params can not be null');
        }
    }

    /**
     * Delete a link between a Team and a League in which the team participates.
     * @param team the Team
     * @param league the League
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamParticipatesInLeague($team, $league)
    {
        (new TeamManager($this->db, $this->objLayer))->deleteParticipatesIn($league, $team);
    }

    /**
     * Store a link between a Team and a League for which the team is the winner.
     * @param team the Team to be linked
     * @param league the League to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamWinnerOfLeague($team, $league)
    {
        (new LeagueManager($this->db, $this->objLayer))->storeWinner($team, $league);
    }

    /**
     * Returns a league or team depending on which parameter is not null
     *
     *  * Return the League won by a given Team.
     * @param team the Team
     * @return the League in won by the Team
     * @throws RDException in case an error occurred during the restore operation
     *
     * Return the Team which is the winner of a given League.
     * @param league the League
     * @return a Team which is the winner of the League
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeamWinnerOfLeague($team = null, $league = null)
    {
        //return league
        if($team != null) {
         return (new TeamManager($this->db, $this->objLayer))->restoreLeagueWinnerOf($team);
        }
        //return team
        else if($league != null) {
            return (new LeagueManager($this->db, $this->objLayer))->restoreWinner($league);
        }
        else{
            throw new RDException("both params can not be null");
        }
    }

    /**
     * Delete a link between a Team and a League won by the Team.
     * @param Entity\TeamImpl $team the Team
     * @param Entity\LeagueImpl $league the League
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamWinnerOfLeague($team, $league)
    {
        (new LeagueManager($this->db, $this->objLayer))->deleteWinner($team, $league);
    }

    /**
     * Store a link between a League and a SportsVenue used by the league.
     * @param league the League to be linked
     * @param sportsVenue the SportsVenue to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeLeagueSportsVenue($league, $sportsVenue)
    {
        $mgmt = new SportsVenueManager($this->db, $this->objLayer);
        $mgmt->storeLeagueUsedIn($league, $sportsVenue);
    }

    /**
     * Returns a sports venue or an array of leagues depending on which parameter is not null
     *
     * Return SportsVenues used by a given League.
     * @param league the League
     * @return an Iterator with all SportsVenues used by the League
     * @throws RDException in case an error occurred during the restore operation
     *
     * Return the Leagues using a given SportsVenue.
     * @param sportsVenue the SportsVenue
     * @return an Iterator of all Leagues using the SportsVenue
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreLeagueSportsVenue($league = null,$sportsVenue = null)
    {
        $mgmt = null;
        //return all sports venues
       if($league != null){
           return (new LeagueManager($this->db, $this->objLayer))->restoreSportsVenues($league);
       }
       //return all leagues
        else if ($sportsVenue != null){
            $mgmt = new SportsVenueManager($this->db, $this->objLayer);
            return $mgmt->restoreLeaguesUsedIn($sportsVenue);
        }
        else{
            throw new RDException($string='Both params can not be null');
        }
    }

    /**
     * Delete a link between a League and a SportsVenue used by the league.
     * @param league the League
     * @param sportsVenue the SportsVenue
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeagueSportsVenue($league, $sportsVenue)
    {
        $mgmt = new SportsVenueManager($this->db, $this->objLayer);
        $mgmt->deleteLeagueUsedIn($league, $sportsVenue);
    }

    /**
     * Store a link between a League and a Round of matches in the league.
     * @param Entity\LeagueImpl $league the League to be linked
     * @param Entity\RoundImpl $round the Round to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeLeagueRound($league, $round)
    {
        (new LeagueManager($this->db, $this->objLayer))->storeRound($league, $round);
    }

    /**
     * Return Rounds of matches for a given League.
     * @param league the League
     * @return an Iterator with all Rounds of matches in the League
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreLeagueRound($league)
    {
        return (new LeagueManager($this->db, $this->objLayer))->restoreRounds($league);
    }

    /**
     * Delete a link between a League and a Round of matches in the league.
     * @param league the League
     * @param round the Round
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeagueRound($league, $round)
    {
        (new LeagueManager($this->db, $this->objLayer))->deleteRound($league, $round);
    }

    /**
     * Store a link between a Round and a Match to be played in the Round.
     * @param Entity\RoundImpl $round the Round to be linked
     * @param Entity\MatchImpl $match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeRoundMatch($round, $match)
    {
        (new MatchManager($this->db, $this->objLayer))->storeRound($round, $match);
    }

    /**
     * Return Matches played in a given Round.
     * @param round the Round
     * @return an Iterator with all matches played in the round
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreRoundMatch($round)
    {
        return (new RoundManager($this->db, $this->objLayer))->restoreMatches($round);
    }

    /**
     * Delete a link between a Round and a Match to be played in the Round.
     * @param round the Round
     * @param match the Match
     * @throws RDException in case an error occurred during the store operation
     */
    public function  deleteRoundMatch($round, $match)
    {
        (new MatchManager($this->db, $this->objLayer))->deleteRound($round, $match);
    }

    /**
     * Store a link between a Match and a SportsVenue used in the match.
     * @param match the Match to be linked
     * @param sportsVenue the SportsVenue to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeMatchSportsVenue($match, $sportsVenue)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->storeSportsVenue($match, $sportsVenue);
    }

    /**
     * Returns a sportsvenue or an array of matches depending on which parameter is not null
     *
     * Return SportsVenue where a given Match was played.
     * @param match the Match
     * @return SportsVenue where the Match was played
     * @throws RDException in case an error occurred during the restore operation
     *
     * Return the Matches played at a given SportsVenue.
     * @param sportsVenue the SportsVenue
     * @return an Iterator of all Matches played at the SportsVenue
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreMatchSportsVenue($match = null, $sportsVenue = null)
    {
        $mgmt = null;
        //return a sports venue where match is played
        if($match != null){
            $mgmt = new MatchManager($this->db, $this->objLayer);
            return $mgmt->restoreSportsVenue($match);
        }
        //return iterature of matches played at this sprots venue
        elseif ($sportsVenue != null){
            return (new SportsVenueManager($this->db, $this->objLayer))->restoreMatchesPlayedIn($sportsVenue);
        }
        else{
            throw new RDException($string='both params can not be null');
        }
    }

    /**
     * Delete a link between a Match and a SportsVenue used in the match.
     * @param match the Match
     * @param sportsVenue the SportsVenue
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteMatchSportsVenue($match, $sportsVenue)
    {
        $mgmt = new MatchManager($this->db, $this->objLayer);
        $mgmt->deleteSportsVenue($match);
    }


}