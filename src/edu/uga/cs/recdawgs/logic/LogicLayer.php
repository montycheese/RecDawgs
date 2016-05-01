<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/20/16
 * Time: 10:29
 */

namespace edu\uga\cs\recdawgs\logic;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\RDException as RDException;

interface LogicLayer {

    //session
    //store student obj in session
    /**
     * @param String $userName
     * @param String $password
     * @throws RDException if incorrect username/pw
     * @return String $response a response saying the student/admin obj has been located. echo their ID.
     */
    public function login($userName, $password);

    /**
     * Destroy the user's session.
     *
     * @return void
     */
    public function logout();


    //find
    /**
     * @param Entity\TeamImpl A model team whose attributes will be used as a template to query a set of teams from the sys.
     * @return Persistence\TeamIterator An iterator of all teams that match the attributes of the modelTeam
     * or null if none found
     */
    public function findTeam($modelTeam);

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\LeagueImpl $modelLeague
     * @return Persistence\LeagueIterator or null
     */
    public function findLeague($modelLeague);

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\studentImpl $modelStudent
     * @return Persistence\StudentIterator or null
     */
    public function findStudent($modelStudent);

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\AdministratorImpl $modelAdmin
     * @return Persistence\AdministratorIterator or null
     */
    public function findAdmin($modelAdmin);

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\SportsVenueImpl $modelSportsVenue
     * @return Persistence\SportsVenueIterator or null
     */
    public function findSportVenue($modelSportsVenue);


    //public function findTeamMembers($team);
//    public function findAllLeagueTeams($league);
  //  public function findAllLeagueSportsVenues($league);
    //public function findAllLeagueMatches($league);


    /**
     * @param Entity\LeagueImpl $league The league to find the winner of
     * @return mixed returns the Team that is the winner of the league or null if there is not a winner yet.
     */
    //public function findLeagueWinner($league);
    //public function findMatchScoreReports($match);



    //create
    /**
     * Register a student to the system.
     * 
     * @param String $firstName
     * @param String $lastName
     * @param String $userName
     * @param String $password
     * @param String $emailAddress
     * @param String $studentId
     * @param String $major
     * @param String $address
     * @throws RDException If any field is not set, or if username, email, or studentId is not unique.
     * @return int $studentId The persistence DB of the student obj created
     */
    public function createStudent($firstName, $lastName, $userName, $password, $emailAddress, $studentId, $major, $address);

    /**
     * Create a team in the system that is part of a league and contains a team captain.
     *
     * @param Entity\TeamImpl $teamName
     * @param Entity\StudentImpl $student
     * @param Entity\LeagueImpl $league
     * @throws RDException if team name already exists or one of the parameters is null
     * @return int $teamId The ID of the team obj created.
     */
    public function createTeam($teamName, $student, $league);

    /**
     * Create a new empty league in the system
     *
     * @param String $name
     * @param String $leagueRules
     * @param String $matchRules
     * @param boolean $isIndoor
     * @param int $minTeams
     * @param int $maxTeams
     * @param int $minMembers
     * @param int $maxMembers
     * @throws RDException if league name already exists or one of the parameters is null
     * @return int $leagueId Id of the obj created.
     */
    public function createLeague($name, $leagueRules, $matchRules, $isIndoor, $minTeams, $maxTeams, $minMembers, $maxMembers);

    /**
     * @param String $name
     * @param boolean $isIndoor
     * @param String $address
     * @return int
     */
    public function createSportsVenue($name, $isIndoor, $address);

    /**
     * Allow a captain to input score of his/her match
     * ScoreReport is created linking Student (Captain) and Match with the scores
     * If this is the second ScoreReport of the Match, invoke the ConfirmMatchScore extension
     *
     * @param Entity\StudentImpl $captain Must be a captain of a team
     * @param Entity\MatchImpl $match
     * @param int $homeTeamScore
     * @param int $awayTeamScore
     * @throws RDException if student is not a captain of a team, if scores are negative or if any obj is null.
     * @return int $scoreReportId
     */
    public function enterMatchScore($captain, $match, $homeTeamScore, $awayTeamScore);
    /**
     * Allow a team captain or admin to schedule a match in the future
     * @param $team
     * @param $match
     * @param $venue
     * @param $date
     * @throws \edu\uga\cs\recdawgs\RDException if date is set in the past.
     * @return \DateTime $date The date the match is set to be played
     */
    public function scheduleMatch($team, $match, $venue, $date);

    //update
    //TODO add params to methods
    public function updateUser($userId=-1,$firstName=null, $lastName=null, $userName=null, $password=null, $emailAddress=null,$studentId=null, $major=null, $address=null);
    public function updateTeam($teamName, $newName=null, $teamCaptain=null, $league=null, $winnerOfLeague=null);
    public function updateLeague($leagueName, $newName=null, $leagueRules=null, $matchRules=null, $isIndoor=null, $minTeams=null, $maxTeams=null, $minMembers=null, $maxMembers=null, $winnerOfLeague=null);
    public function updateSportsVenue($venueName, $newName=null, $isIndoor=null, $address=null);
    public function resetPassword();
    #public function updateScoreReport($match, );
    
    //join
    /**
     * Called to join a player to a team
     *
     * When this method is called only set a values for $teamObj and $student OR $teamName and $studentId
     * Only those two combinations can be used:
     * e.g. joinTeam($teamObj=$myTeam, $user=$myUser); or joinTeam($teamName="Team Rocket", $userId=$myUserId);
     *
     * This is used to simulate overloading methods in PHP since this feature is unique to Java.
     *
     * @param Entity\TeamImpl $teamObj The team the player is joining
     * @param String $teamName The string name of the team to join
     * @param Entity\StudentImpl $studentObj The Student persistence object of the user joining the team
     * @param int $studentId The MySQL id of the student joining the team
     * @return int ID of the team joined
     */
    public function joinTeam($teamObj=null, $teamName=null, $studentObj=null, $studentId=-1);

    /*
     * @see Refer to doc of LogicLayer::joinTeam for details of logic
     *
     *
     * @param Entity\LeagueImpl $leagueObj
     * @param String $leagueName
     * @param Entity\TeamImpl $teamObj
     * @param int $teamId
     * @return int ID of the League Joined

    public function joinLeague($leagueObj, $leagueName, $teamObj, $teamId=-1);*/
    //public function assignSportsVenueToLeague();

    //delete
    /**
     * Deletes a user and all their links (i.e. team memberships)
     * if a user is a team captain, it removes them as team captain and an admin has to
     * select a new captain for a team. If the team has only one user, then the team
     * is destroyed also.
     *
     * @param Entity\UserImpl $user The user to be deleted
     * @return void
     */
    public function deleteUser($user);

    /**
     * Deletes a sports venue given that there are no matches scheduled there.
     *
     * @param Entity\SportsVenueImpl $venue
     * @throws RDException If matches are scheduled at that venue.
     * @return void
     */
    public function deleteSportsVenue($venue);

    /**
     * Delete a league and all its teams
     *
     * @param Entity\LeagueImpl $league
     * @return void
     */
    public function deleteLeague($league);

    //misc admin/system user cases
    /**
     * Automatically called from the end of the creation of the second score report of  a match
     *  if the scores in the two ScoreReports are the same, the score in the Match is set to be as
     * reported; otherwise, a message ConflictingScoresReported message
     *
     * @param Entity\ScoreReportImpl $report1
     * @param Entity\ScoreReportImpl $report2
     * @param Entity\MatchImpl $match
     * @throws RDException if the scores conflict. The admin needs to resolve this.
     * @return void
     */
    public function confirmMatchScore($report1, $report2, $match);

    /**
     * resolves match score when 2 score reports differ.
     *
     * @param int $fixedHomeScore
     * @param int $fixedAwayScore
     * @param Entity\MatchImpl $match
     * @throws RDException if match is null or scores are negative
     * @return void
     */
    public function resolveMatchScore($fixedHomeScore, $fixedAwayScore, $match);

    /**
     * Called to appoint a player as a team captain
     *
     * When this method is called only set a values for $teamObj and $student OR $teamName and $studentId
     * Only those two combinations can be used:
     * e.g. joinTeam($teamObj=$myTeam, $user=$myUser); or joinTeam($teamName="Team Rocket", $userId=$myUserId);
     *
     * This is used to simulate overloading methods in PHP since this feature is unique to Java.
     *
     * @param Entity\TeamImpl $teamObj The team the player is joining
     * @param String $teamName The string name of the team to join
     * @param Entity\StudentImpl $studentObj The Student persistence object of the user joining the team
     * @param int $studentId The MySQL id of the student joining the team
     * @return int ID of the team joined
     */
    public function appointCaptain($teamObj=null, $teamName=null, $studentObj=null, $studentId=-1);

    /**
     * the Leagues satisfying their conditions are activated and their season schedules are
     * created, organized into Rounds of Matches; a list of inactive Leagues (not satisfying their
     * conditions) is reported
     * @return void
     */
    public function closeEnrollment();

    /**
     * Team is set as league winner
     *
     * @param Entity\LeagueImpl $league
     * @param Entity\TeamImpl $team
     * @RDException is thrown if team is not in the league.
     * @return void
     */
    public function selectLeagueWinner($league, $team);

    /*use cases that may be propagated to presentation layer
    viewLeagueResults


     *
     *
     */

}