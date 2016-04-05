<?php
namespace edu\uga\cs\recdawgs\object\impl;

use edu\uga\cs\recdawgs\entity\Match as Match;
use edu\uga\cs\recdawgs\entity\Round as Round;
use edu\uga\cs\recdawgs\object\ObjectLayer as ObjectLayer;
use edu\uga\cs\recdawgs\RDException as RDException;


class ObjectLayerImpl implements ObjectLayer{

    /**
     * Create a new Administrator object, given the set of initial attribute values. Or With undefined attributes if non are passed.
     * @param firstName String the first name
     * @param lastName String the last name
     * @param userName String the user name (login name)
     * @param password String the password
     * @param emailAddress String the email address
     * @return a new Administrator object instance with the given attribute values
     * @throws RDException in case either firstName, lastName, or userName is null
     */
    public function createAdministrator($firstName = null, $lastName = null, $userName = null, $password = null, $emailAddress = null)
    {
        // TODO: Implement createAdministrator() method.
    }

    /**
     * Return an iterator of Administrator objects satisfying the search criteria given in the modelAdministrator object.
     * @param modelAdministrator a model Administrator object specifying the search criteria
     * @return an Iterator of the located Administrator objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findAdministrator($modelAdministrator)
    {
        // TODO: Implement findAdministrator() method.
    }

    /**
     * Store a given Administrator object in persistent data store.
     * @param administrator the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeAdministrator($administrator)
    {
        // TODO: Implement storeAdministrator() method.
    }

    /**
     * Delete this Administrator object.
     * @param administrator the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteAdministrator($administrator)
    {
        // TODO: Implement deleteAdministrator() method.
    }

    /**
     * Create a new Student object, given the set of initial attribute values.
     * @param firstName the first name
     * @param lastName the last name
     * @param userName the user (login) name
     * @param password the password
     * @param emailAddress the email address
     * @param studentId the student identifier
     * @param major the student's major
     * @param address the student's address
     * @return a new Student object instance with the given attribute values
     * @throws RDException in case either firstName, lastName, userName, or studentId is null
     */
    public function createStudent($firstName = null, $lastName = null, $userName = null,
                                  $password = null, $emailAddress = null, $studentId = null, $major = null, $address = null)
    {
        // TODO: Implement createStudent() method.
    }

    /**
     * Return an iterator of Student objects satisfying the search criteria given in the modelStudent object.
     * @param modelStudent a model Student object specifying the search criteria
     * @return an Iterator of the located Student objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findStudent($modelStudent)
    {
        // TODO: Implement findStudent() method.
    }

    /**
     * Store a given Student object in persistent data store.
     * @param student the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeStudent($student)
    {
        // TODO: Implement storeStudent() method.
    }

    /**
     * Delete this Student object.
     * @param student the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteStudent($student)
    {
        // TODO: Implement deleteStudent() method.
    }

    /**
     * Create a new League object, given the set of initial attribute values.
     * @param name String the name of the league
     * @param leagueRules String the rules of participating in the league
     * @param matchRules String the match rules for matches played in the league
     * @param isIndoor boolean is the league an indoor league?
     * @param minTeams int the minimum number of teams in the league
     * @param maxTeams int the maximum number of teams in the league
     * @param minPlayers int the minimum number of players in teams in the league
     * @param maxPlayers int the maximum number of players in teams in the league
     * @return League a new League instance with the given attribute values
     * @throws RDException in case either the name is null or any of the team/player numbers is not positive or the given maximum is less than the corresponding minimum
     */
    public function createLeague($name = null, $leagueRules = null, $matchRules = null,
                                 $isIndoor = null, $minTeams = null, $maxTeams = null, $minPlayers = null, $maxPlayers = null)
    {
        // TODO: Implement createLeague() method.
    }

    /**
     * Return an iterator of League objects satisfying the search criteria given in the modelLeague object.
     * @param modelLeague a model League object specifying the search criteria
     * @return an Iterator of the located League objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findLeague($modelLeague)
    {
        // TODO: Implement findLeague() method.
    }

    /**
     * Store a given League object in persistent data store.
     * @param league the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeLeague($league)
    {
        // TODO: Implement storeLeague() method.
    }

    /**
     * Delete this League object.
     * @param league the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteLeague($league)
    {
        // TODO: Implement deleteLeague() method.
    }

    /**
     * Create a new Team object, given the set of initial attribute values.
     * @param name the name of the team
     * @param student the student who is the captain of the new team
     * @param league the league in which the new team will participate
     * @return a new Team object instance with the given attribute values
     * @throws RDException in case name is null
     */
    public function createTeam($name = null, $student = null, $league = null)
    {
        // TODO: Implement createTeam() method.
    }

    /**
     * Return an iterator of Team objects satisfying the search criteria given in the modelTeam object.
     * @param modelTeam a model Team object specifying the search criteria
     * @return an Iterator of the located Team objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findTeam($modelTeam)
    {
        // TODO: Implement findTeam() method.
    }

    /**
     * Store a given Team object in persistent data store.
     * @param team the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeTeam($team)
    {
        // TODO: Implement storeTeam() method.
    }

    /**
     * Delete this Team object.
     * @param team the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteTeam($team)
    {
        // TODO: Implement deleteTeam() method.
    }

    /**
     * Create a new SportsVenue object, given the set of initial attribute values.
     * @param name the name of the sports venue
     * @param address the address of the sports venue
     * @param isIndoor is the sports venue an indoor venue?
     * @return a new SportsVenue object instance with the given attribute values
     * @throws RDException in case name is null
     */
    public function createSportsVenue($name = null, $address = null, $isIndoor = null)
    {
        // TODO: Implement createSportsVenue() method.
    }

    /**
     * Return an iterator of SportsVenue objects satisfying the search criteria given in the modelSportsVenue object.
     * @param modelSportsVenue a model SportsVenue object specifying the search criteria
     * @return an Iterator of the located SportsVenue objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findSportsVenue($modelSportsVenue)
    {
        // TODO: Implement findSportsVenue() method.
    }

    /**
     * Store a given SportsVenue object in persistent data store.
     * @param sportsVenue the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeSportsVenue($sportsVenue)
    {
        // TODO: Implement storeSportsVenue() method.
    }

    /**
     * Delete this SportsVenue object.
     * @param sportsVenue the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteSportsVenue($sportsVenue)
    {
        // TODO: Implement deleteSportsVenue() method.
    }

    /**
     * Create a new Match object, given the set of initial attribute values.
     * @param homePoints the points won by the home team (must be non-negative)
     * @param awayPoints the points won by the away team (must be non-negative)
     * @param date the date of the match
     * @param isCompleted has the match been completed?
     * @param homeTeam the team which is the home team in this match
     * @param awayTeam the team which is the away team in this match
     * @return a new Match object instance with the given attribute values
     * @throws RDException in case any of the po$arguments is negative or either of the teams is null or if the given teams are not in the same league
     */
    public function createMatch($homePoints = null, $awayPoints = null, $date = null,
                                $isCompleted = null, $homeTeam = null, $awayTeam = null)
    {
        // TODO: Implement createMatch() method.
    }

    /**
     * Return an iterator of Match objects satisfying the search criteria given in the modelMatch object.
     * @param modelMatch a model Match object specifying the search criteria
     * @return an Iterator of the located Match objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findMatch($modelMatch)
    {
        // TODO: Implement findMatch() method.
    }

    /**
     * Store a given Match object in persistent data store.
     * @param match the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeMatch($match)
    {
        // TODO: Implement storeMatch() method.
    }

    /**
     * Delete this Match object.
     * @param match the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteMatch($match)
    {
        // TODO: Implement deleteMatch() method.
    }

    /**
     * Create a new Round object.
     * @param number the number of this round of matches
     * @return a new Round object instance
     * @throws RDException in case the number is not positive
     */
    public function createRound($number = null)
    {
        // TODO: Implement createRound() method.
    }

    /**
     * Return an iterator of Round objects satisfying the search criteria given in the modelRound object.
     * @param modelRound a model Round object specifying the search criteria
     * @return an Iterator of the located Round objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findRound($modelRound)
    {
        // TODO: Implement findRound() method.
    }

    /**
     * Store a given Round object in persistent data store.
     * @param round the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeRound($round)
    {
        // TODO: Implement storeRound() method.
    }

    /**
     * Delete this Round object.
     * @param round the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteRound($round)
    {
        // TODO: Implement deleteRound() method.
    }

    /**
     * Create a new ScoreReport object, given the set of initial attribute values.
     * @param homePoints the points won by the home team (must be non-negative)
     * @param awayPoints the points won by the away team (must be non-negative)
     * @param date the date of the match
     * @param student the Student submitting the match score report
     * @param match the Match for which the score is reported
     * @return a new ScoreReport object instance with the given attribute values
     * @throws RDException in case any of the po$arguments is negative, either student or match is null, or if the student is not the captain of one of the teams in the match
     */
    public function createScoreReport($homePoints = null, $awayPoints = null, $date = null, $student = null, $match = null)
    {
        // TODO: Implement createScoreReport() method.
    }

    /**
     * Return an iterator of ScoreReport objects satisfying the search criteria given in the modelScoreReport object.
     * @param modelScoreReport a model ScoreReport object specifying the search criteria
     * @return an Iterator of the located ScoreReport objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findScoreReport($modelScoreReport)
    {
        // TODO: Implement findScoreReport() method.
    }

    /**
     * Store a given ScoreReport object in persistent data store.
     * @param scoreReport the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeScoreReport($scoreReport)
    {
        // TODO: Implement storeScoreReport() method.
    }

    /**
     * Delete this ScoreReport object.
     * @param scoreReport the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteScoreReport($scoreReport)
    {
        // TODO: Implement deleteScoreReport() method.
    }

    /**
     * Create a new link between a Student captain and a Team.
     * @param student the student who is the captain of the team
     * @param team the team
     * @throws RDException in case either the student and/or the team is null
     */
    public function createStudentCaptainOfTeam($student, $team)
    {
        // TODO: Implement createStudentCaptainOfTeam() method.
    }

    /**
     * Return the student who is the captain of the team (traverse the link isCaptainOf from Team to Student).
     * @param team the team
     * @return the student who is the team's captain
     * @throws RDException in case either the team is null or another error occurs
     */
    public function restoreStudentCaptainOfTeam($team = null, $student = null)
    {
        // TODO: Implement restoreStudentCaptainOfTeam() method.
    }

    /**
     * Delete a link between a student and a team (sever the link isCaptainOf from Team to Student).
     * @param student the student
     * @param team the team
     * @throws RDException in case either the student or team is null or another error occurs
     */
    public function deleteStudentCaptainOfTeam($student, $team)
    {
        // TODO: Implement deleteStudentCaptainOfTeam() method.
    }

    /**
     * Create a new link between a Student who is becoming a member and a Team.
     * @param student the student who is a member of the team
     * @param team the team
     * @throws RDException in case either the student and/or the team is null
     */
    public function createStudentMemberOfTeam($student, $team)
    {
        // TODO: Implement createStudentMemberOfTeam() method.
    }

    /**
     * Return the students who are members of the team (traverse the link isMemberOf from Team to Student).
     * @param team the team
     * @return the iterator of Students who are members of the team
     * @throws RDException in case either the team is null or another error occurs
     */
    public function restoreStudentMemberOfTeam($team = null, $student = null)
    {
        // TODO: Implement restoreStudentMemberOfTeam() method.
    }

    /**
     * Delete a link between a student and a team (sever the link isMemberOf from Team to Student).
     * @param student the student
     * @param team the team
     * @throws RDException in case either the student or team is null or another error occurs
     */
    public function deleteStudentMemberOfTeam($student, $team)
    {
        // TODO: Implement deleteStudentMemberOfTeam() method.
    }

    /**
     * Create a new link between a Team which is a home team in a Match.
     * @param team the home team
     * @param match the match
     * @throws RDException in case either the team and/or the match is null
     */
    public function createTeamHomeTeamMatch($team, $match)
    {
        // TODO: Implement createTeamHomeTeamMatch() method.
    }

    /**
     * Return the home team of the match (traverse the link isHomeTeam from Match to Team).
     * @param match the match
     * @return the Team which is the home team in the match
     * @throws RDException in case either the match is null or another error occurs
     */
    public function restoreTeamHomeTeamMatch($match = null, $team = null)
    {
        // TODO: Implement restoreTeamHomeTeamMatch() method.
    }

    /**
     * Delete a link between a home team and a match (sever the link isHomeTeam from Match to Team).
     * @param team the team
     * @param match the match
     * @throws RDException in case either the team or match is null or another error occurs
     */
    public function deleteTeamHomeTeamMatch($team, $match)
    {
        // TODO: Implement deleteTeamHomeTeamMatch() method.
    }

    /**
     * Create a new link between a Team which is a away team in a Match.
     * @param team the away team
     * @param match the match
     * @throws RDException in case either the team and/or the match is null
     */
    public function createTeamAwayTeamMatch($team, $match)
    {
        // TODO: Implement createTeamAwayTeamMatch() method.
    }

    /**
     * Return the away team of the match (traverse the link isAwayTeam from Match to Team).
     * @param match the match
     * @return the Team which is the away team in the match
     * @throws RDException in case either the match is null or another error occurs
     */
    public function restoreTeamAwayTeamMatch($match = null, $team = null)
    {
        // TODO: Implement restoreTeamAwayTeamMatch() method.
    }

    /**
     * Delete a link between a away team and a match (sever the link isAwayTeam from Match to Team).
     * @param team the team
     * @param match the match
     * @throws RDException in case either the team or match is null or another error occurs
     */
    public function deleteTeamAwayTeamMatch($team, $match)
    {
        // TODO: Implement deleteTeamAwayTeamMatch() method.
    }

    /**
     * Create a new link between a Team and a League in which it competes.
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team and/or the league is null
     */
    public function createTeamParticipatesInLeague($team, $league)
    {
        // TODO: Implement createTeamParticipatesInLeague() method.
    }

    /**
     * Return the League in which a given team competes (traverse the link participatesIn from Team to League).
     * @param team the team
     * @return the League in which the team competes
     * @throws RDException in case either the team is null or another error occurs
     */
    public function restoreTeamParticipatesInLeague($team = null, $league = null)
    {
        // TODO: Implement restoreTeamParticipatesInLeague() method.
    }

    /**
     * Delete a link between a Team and a League (sever the link isParticipatesIn from League to Team).
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team or league is null or another error occurs
     */
    public function deleteTeamParticipatesInLeague($team, $league)
    {
        // TODO: Implement deleteTeamParticipatesInLeague() method.
    }

    /**
     * Create a new link between a Team and a League in which the Team is the winner.
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team and/or the league is null
     */
    public function createTeamWinnerOfLeague($team, $league)
    {
        // TODO: Implement createTeamWinnerOfLeague() method.
    }

    /**
     * Return the League in which a given team is the winner (traverse the link isWinnerOf from Team to League).
     * @param team the team
     * @return the League in which the team is the winner
     * @throws RDException in case either the team is null or another error occurs
     */
    public function restoreTeamWinnerOfLeague($team = null, $league = null)
    {
        // TODO: Implement restoreTeamWinnerOfLeague() method.
    }

    /**
     * Delete a link between a Team and a League (sever the link isWinnerOf from League to Team).
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team or league is null or another error occurs
     */
    public function deleteTeamWinnerOfLeague($team, $league)
    {
        // TODO: Implement deleteTeamWinnerOfLeague() method.
    }

    /**
     * Create a new link between a League and a SportsVenue in which the League is the winner.
     * @param league the League
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the league and/or the sportsVenue is null
     */
    public function createLeagueSportsVenue($league, $sportsVenue)
    {
        // TODO: Implement createLeagueSportsVenue() method.
    }

    /**
     * Return the SportsVenues used by a given League is the winner (traverse the link has from League to SportsVenue).
     * @param league the League
     * @return an Iterator of SportsVenues used by the league
     * @throws RDException in case either the league is null or another error occurs
     */
    public function restoreLeagueSportsVenue($league = null, $sportsVenue = null)
    {
        // TODO: Implement restoreLeagueSportsVenue() method.
    }

    /**
     * Delete a link between a League and a SportsVenue (sever the link has from SportsVenue to League).
     * @param league the League
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the league or sportsVenue is null or another error occurs
     */
    public function deleteLeagueSportsVenue($league, $sportsVenue)
    {
        // TODO: Implement deleteLeagueSportsVenue() method.
    }

    /**
     * Create a new link between a League and a Round of matches in the League.
     * @param league the League
     * @param round the Round
     * @throws RDException in case either the league and/or the round is null
     */
    public function createLeagueRound($league, $round)
    {
        // TODO: Implement createLeagueRound() method.
    }

    /**
     * Return the Rounds of matches in a given League (traverse the link includes from League to Round).
     * @param league the League
     * @return an Iterator of Rounds of matches in the league
     * @throws RDException in case either the league is null or another error occurs
     */
    public function restoreLeagueRound($league)
    {
        // TODO: Implement restoreLeagueRound() method.
    }

    /**
     * Delete a link between a League and a Round of matches (sever the link includes from Round to League).
     * @param league the League
     * @param round the Round
     * @throws RDException in case either the league or round is null or another error occurs
     */
    public function deleteLeagueRound($league, $round)
    {
        // TODO: Implement deleteLeagueRound() method.
    }

    /**
     * Create a new link between a Round and a Match played in it.
     * @param round the Round
     * @param match the Match
     * @throws RDException in case either the round and/or the match is null
     */
    public function createRoundMatch($round, $match)
    {
        // TODO: Implement createRoundMatch() method.
    }

    /**
     * Return the Matches played in a given Round (traverse the link includes from Round to Match).
     * @param round the Round
     * @return an Iterator of Matches played in the round
     * @throws RDException in case either the round is null or another error occurs
     */
    public function restoreRoundMatch($round)
    {
        // TODO: Implement restoreRoundMatch() method.
    }

    /**
     * Delete a link between a Round and a Match (sever the link includes from Match to Round).
     * @param round Round Round
     * @param match Match Match
     * @throws RDException in case either the round or match is null or another error occurs
     */
    public function deleteRoundMatch($round, $match)
    {
        // TODO: Implement deleteRoundMatch() method.
    }

    /**
     * Create a new link between a Match and a SportsVenue where the Match is played.
     * @param match the Match
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the match and/or the sportsVenue is null
     */
    public function createMatchSportsVenue($match, $sportsVenue)
    {
        // TODO: Implement createMatchSportsVenue() method.
    }

    /**
     * Return the SportsVenue where a given Match is played (traverse the link isPlayedAt from Match to SportsVenue).
     * @param match the Match
     * @return the SportsVenue where the given match is played
     * @throws RDException in case either the match is null or another error occurs
     */
    public function restoreMatchSportsVenue($match = null, $sportsVenue = null)
    {
        // TODO: Implement restoreMatchSportsVenue() method.
    }

    /**
     * Delete a link between a Match and a SportsVenue (sever the link isPlayedAt from SportsVenue to Match).
     * @param match the Match
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the match or sportsVenue is null or another error occurs
     */
    public function deleteMatchSportsVenue($match, $sportsVenue)
    {
        // TODO: Implement deleteMatchSportsVenue() method.
    }

    function __construct()
    {
        // TODO: Implement __construct() method.
    }
}