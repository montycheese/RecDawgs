<?php
namespace edu\uga\cs\recdawgs\object;

interface ObjectLayer
{
    /**
     * Create a new Administrator object, given the set of initial attribute values. Or With undefined attributes if non are passed.
     * @param firstName the first name
     * @param lastName the last name
     * @param userName the user name (login name)
     * @param password the password
     * @param emailAddress the email address
     * @return a new Administrator object instance with the given attribute values
     * @throws RDException in case either firstName, lastName, or userName is null
     */
    public function createAdministrator($firstName=null, $lastName=null, $userName=null, $password=null, $emailAddress=null); // add exception



    /**
     * Return an iterator of Administrator objects satisfying the search criteria given in the modelAdministrator object.
     * @param modelAdministrator a model Administrator object specifying the search criteria
     * @return an Iterator of the located Administrator objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findAdministrator($modelAdministrator); // add exception
    
    /**
     * Store a given Administrator object in persistent data store.
     * @param administrator the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeAdministrator($administrator); // add exception
    
    /**
     * Delete this Administrator object.
     * @param administrator the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteAdministrator($administrator); // add exception 
    
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
        $password = null, $emailAddress = null, $studentId = null, $major = null, $address = null); // add exception
    
    /**
     * Return an iterator of Student objects satisfying the search criteria given in the modelStudent object.
     * @param modelStudent a model Student object specifying the search criteria
     * @return an Iterator of the located Student objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findStudent($modelStudent); // add exception
    
    /**
     * Store a given Student object in persistent data store.
     * @param student the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeStudent($student); // add exception
    
    /**
     * Delete this Student object.
     * @param student the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteStudent($student); // add exception      

    /**
     * Create a new League object, given the set of initial attribute values.
     * @param name the name of the league
     * @param leagueRules the rules of participating in the league
     * @param matchRules the match rules for matches played in the league
     * @param isIndoor is the league an indoor league?
     * @param minTeams the minimum number of teams in the league
     * @param maxTeams the maximum number of teams in the league
     * @param minPlayers the minimum number of players in teams in the league
     * @param maxPlayers the maximum number of players in teams in the league
     * @return a new League instance with the given attribute values
     * @throws RDException in case either the name is null or any of the team/player numbers is not positive or the given maximum is less than the corresponding minimum
     */
    public function createLeague($name = null, $leagueRules = null, $matchRules,
            $isIndoor = null, $minTeams = null, $maxTeams = null, $minPlayers = null, $maxPlayers = null); // add exception

    /**
     * Return an iterator of League objects satisfying the search criteria given in the modelLeague object.
     * @param modelLeague a model League object specifying the search criteria
     * @return an Iterator of the located League objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findLeague($modelLeague); // add exception
    
    /**
     * Store a given League object in persistent data store.
     * @param league the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeLeague($league); // add exception
    
    /**
     * Delete this League object.
     * @param league the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteLeague($league); // add exception    

    /**
     * Create a new Team object, given the set of initial attribute values.
     * @param name the name of the team
     * @param student the student who is the captain of the new team
     * @param league the league in which the new team will participate
     * @return a new Team object instance with the given attribute values
     * @throws RDException in case name is null
     */
    public function createTeam($name = null, $student = null, $league = null); // add exception

    /**
     * Return an iterator of Team objects satisfying the search criteria given in the modelTeam object.
     * @param modelTeam a model Team object specifying the search criteria
     * @return an Iterator of the located Team objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findTeam($modelTeam); // add exception
    
    /**
     * Store a given Team object in persistent data store.
     * @param team the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeTeam($team); // add exception
    
    /**
     * Delete this Team object.
     * @param team the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteTeam($team); // add exception    
 
    /**
     * Create a new SportsVenue object, given the set of initial attribute values.
     * @param name the name of the sports venue
     * @param address the address of the sports venue
     * @param isIndoor is the sports venue an indoor venue?
     * @return a new SportsVenue object instance with the given attribute values
     * @throws RDException in case name is null
     */
    public function createSportsVenue($name = null, $address = null, $isIndoor = null); // add exception

    /**
     * Return an iterator of SportsVenue objects satisfying the search criteria given in the modelSportsVenue object.
     * @param modelSportsVenue a model SportsVenue object specifying the search criteria
     * @return an Iterator of the located SportsVenue objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findSportsVenue($modelSportsVenue); // add exception
    
    /**
     * Store a given SportsVenue object in persistent data store.
     * @param sportsVenue the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeSportsVenue($sportsVenue); // add exception
    
    /**
     * Delete this SportsVenue object.
     * @param sportsVenue the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteSportsVenue($sportsVenue); // add exception    

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
            $isCompleted = null, $homeTeam = null, $awayTeam = null); // add exception

    /**
     * Return an iterator of Match objects satisfying the search criteria given in the modelMatch object.
     * @param modelMatch a model Match object specifying the search criteria
     * @return an Iterator of the located Match objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findMatch($modelMatch); // add exception
    
    /**
     * Store a given Match object in persistent data store.
     * @param match the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeMatch($match); // add exception
    
    /**
     * Delete this Match object.
     * @param match the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteMatch($match); // add exception    

    /**
     * Create a new Round object.
     * @param number the number of this round of matches
     * @return a new Round object instance
     * @throws RDException in case the number is not positive
     */
    public function createRound($number = null); // add exception
    
    /**
     * Return an iterator of Round objects satisfying the search criteria given in the modelRound object.
     * @param modelRound a model Round object specifying the search criteria
     * @return an Iterator of the located Round objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findRound($modelRound); // add exception
    
    /**
     * Store a given Round object in persistent data store.
     * @param round the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeRound($round); // add exception
    
    /**
     * Delete this Round object.
     * @param round the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteRound($round); // add exception    

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
    public function createScoreReport($homePoints = null, $awayPoints = null, $date = null, $student = null, $match = null); // add exception

    /**
     * Return an iterator of ScoreReport objects satisfying the search criteria given in the modelScoreReport object.
     * @param modelScoreReport a model ScoreReport object specifying the search criteria
     * @return an Iterator of the located ScoreReport objects
     * @throws RDException in case there is a problem with the retrieval of the requested objects
     */
    public function findScoreReport($modelScoreReport); // add exception
    
    /**
     * Store a given ScoreReport object in persistent data store.
     * @param scoreReport the object to be persisted
     * @throws RDException in case there was an error while persisting the object
     */
    public function storeScoreReport($scoreReport); // add exception
    
    /**
     * Delete this ScoreReport object.
     * @param scoreReport the object to be deleted.
     * @throws RDException in case there is a problem with the deletion of the object
     */
    public function deleteScoreReport($scoreReport); // add exception    

    // Operations for handling associations
    //
    
    // Student--isCaptainOf-->Team;   multiplicity: 1 - *
    //
    /**
     * Create a new link between a Student captain and a Team.
     * @param student the student who is the captain of the team
     * @param team the team
     * @throws RDException in case either the student and/or the team is null
     */
    public function createStudentCaptainOfTeam($student, $team); // add exception
    
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
    public function restoreStudentCaptainOfTeam($student = null, $team = null); // add exception
    
    /**
     * Delete a link between a student and a team (sever the link isCaptainOf from Team to Student).
     * @param student the student
     * @param team the team
     * @throws RDException in case either the student or team is null or another error occurs
     */
    public function deleteStudentCaptainOfTeam($student, $team); // add exception

    // Student--isMemberOf-->Team;   multiplicity: 1..* - *
    //
    /**
     * Create a new link between a Student who is becoming a member and a Team.
     * @param student the student who is a member of the team
     * @param team the team
     * @throws RDException in case either the student and/or the team is null
     */
    public function createStudentMemberOfTeam($student, $team); // add exception
    
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
    public function restoreStudentMemberOfTeam($student = null, $team = null); // add exception
    
    /**
     * Delete a link between a student and a team (sever the link isMemberOf from Team to Student).
     * @param student the student
     * @param team the team
     * @throws RDException in case either the student or team is null or another error occurs
     */
    public function deleteStudentMemberOfTeam($student, $team); // add exception

    // Team--isHomeTeam-->Match;   multiplicity: 1 - *
    //
    /**
     * Create a new link between a Team which is a home team in a Match.
     * @param team the home team 
     * @param match the match
     * @throws RDException in case either the team and/or the match is null
     */
    public function createTeamHomeTeamMatch($team, $match); // add exception
    
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
    public function restoreTeamHomeTeamMatch($team = null, $match = null); // add exception
    
    /**
     * Delete a link between a home team and a match (sever the link isHomeTeam from Match to Team).
     * @param team the team
     * @param match the match
     * @throws RDException in case either the team or match is null or another error occurs
     */
    public function deleteTeamHomeTeamMatch($team, $match); // add exception

    // Team--isAwayTeam-->Match;   multiplicity: 1 - *
    //
    /**
     * Create a new link between a Team which is a away team in a Match.
     * @param team the away team 
     * @param match the match
     * @throws RDException in case either the team and/or the match is null
     */
    public function createTeamAwayTeamMatch($team, $match); // add exception
    
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
    public function restoreTeamAwayTeamMatch($team = null, $match = null); // add exception
    
    /**
     * Delete a link between a away team and a match (sever the link isAwayTeam from Match to Team).
     * @param team the team
     * @param match the match
     * @throws RDException in case either the team or match is null or another error occurs
     */
    public function deleteTeamAwayTeamMatch($team, $match); // add exception

    // Team--participatesIn-->League;   multiplicity: * - 1
    //
    /**
     * Create a new link between a Team and a League in which it competes.
     * @param team the team 
     * @param league the league
     * @throws RDException in case either the team and/or the league is null
     */
    public function createTeamParticipatesInLeague($team, $league); // add exception
    
    /**
     * Returns either a league or an array of teams based on which param is not null
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
    public function restoreTeamParticipatesInLeague($team = null, $league = null); // add exception
    
    /**
     * Delete a link between a Team and a League (sever the link isParticipatesIn from League to Team).
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team or league is null or another error occurs
     */
    public function deleteTeamParticipatesInLeague($team, $league); // add exception

    // Team--isWinnerOf-->League;   multiplicity: 0..1 - 0..1
    //
    /**
     * Create a new link between a Team and a League in which the Team is the winner.
     * @param team the team 
     * @param league the league
     * @throws RDException in case either the team and/or the league is null
     */
    public function createTeamWinnerOfLeague($team, $league); // add exception
    
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
    public function restoreTeamWinnerOfLeague($team = null, $league = null); // add exception
    
    
    /**
     * Delete a link between a Team and a League (sever the link isWinnerOf from League to Team).
     * @param team the team
     * @param league the league
     * @throws RDException in case either the team or league is null or another error occurs
     */
    public function deleteTeamWinnerOfLeague($team, $league); // add exception


    // League--has-->SportsVenue;   multiplicity: * - *
    //
    /**
     * Create a new link between a League and a SportsVenue in which the League is the winner.
     * @param league the League 
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the league and/or the sportsVenue is null
     */
    public function createLeagueSportsVenue($league, $sportsVenue); // add exception
    
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
    public function restoreLeagueSportsVenue($league = null, $sportsVenue = null); // add exception
    
    /**
     * Delete a link between a League and a SportsVenue (sever the link has from SportsVenue to League).
     * @param league the League
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the league or sportsVenue is null or another error occurs
     */
    public function deleteLeagueSportsVenue($league, $sportsVenue); // add exception

    // League--includes-->Round;   multiplicity: 1 - *
    //
    /**
     * Create a new link between a League and a Round of matches in the League.
     * @param league the League 
     * @param round the Round
     * @throws RDException in case either the league and/or the round is null
     */
    public function createLeagueRound($league, $round); // add exception
    
    /**
     * Return the Rounds of matches in a given League (traverse the link includes from League to Round).
     * @param league the League
     * @return an Iterator of Rounds of matches in the league
     * @throws RDException in case either the league is null or another error occurs
     */
    public function restoreLeagueRound($league); // add exception
    
    /**
     * Return the Leagues with the round of matches (traverse the includes from Round to League).
     * @param round the Round
     * @return the League with the given round of matches
     * @throws RDException in case either the round is null or another error occurs
     */
    // Not needed since the assocation is not traversed in this direction
    // public function restoreLeagueRound($round); // add exception
    
    /**
     * Delete a link between a League and a Round of matches (sever the link includes from Round to League).
     * @param league the League
     * @param round the Round
     * @throws RDException in case either the league or round is null or another error occurs
     */
    public function deleteLeagueRound($league, $round); // add exception



    // Round--includes-->Match;   multiplicity: 1 - 1..*
    //
    /**
     * Create a new link between a Round and a Match played in it.
     * @param round the Round
     * @param match the Match
     * @throws RDException in case either the round and/or the match is null
     */
    public function createRoundMatch($round, $match); // add exception
    
    /**
     * Return the Matches played in a given Round (traverse the link includes from Round to Match).
     * @param round the Round
     * @return an Iterator of Matches played in the round
     * @throws RDException in case either the round is null or another error occurs
     */
    public function restoreRoundMatch($round); // add exception
    
    /**
     * Return the Round in which the match is played (traverse the includes from Match to Round).
     * @param match the Match
     * @return the Round in which the given match is played
     * @throws RDException in case either the match is null or another error occurs
     */
    // Not needed since the assocation is not traversed in this direction
    // public function restoreRoundMatch($match); // add exception
    
    /**
     * Delete a link between a Round and a Match (sever the link includes from Match to Round).
     * @param round Round Round
     * @param match Match Match
     * @throws RDException in case either the round or match is null or another error occurs
     */
    public function deleteRoundMatch($round, $match); // add exception


    // Match--isPlayedAt-->SportsVenue;   multiplicity: * - 0..1
    //
    /**
     * Create a new link between a Match and a SportsVenue where the Match is played.
     * @param match the Match 
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the match and/or the sportsVenue is null
     */
    public function createMatchSportsVenue($match, $sportsVenue); // add exception
    
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
    public function restoreMatchSportsVenue($match = null, $sportsVenue = null); // add exception
    
    /**
     * Delete a link between a Match and a SportsVenue (sever the link isPlayedAt from SportsVenue to Match).
     * @param match the Match
     * @param sportsVenue the SportsVenue
     * @throws RDException in case either the match or sportsVenue is null or another error occurs
     */
    public function deleteMatchSportsVenue($match, $sportsVenue); // add exception

}



?>