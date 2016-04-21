<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/20/16
 * Time: 10:40
 */

namespace edu\uga\cs\recdawgs\logic\impl;


use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\logic\LogicLayer;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;
use edu\uga\cs\recdawgs\RDException;

class LogicLayerImpl implements LogicLayer{

    /**
     * @param String $userName
     * @param String $password
     * @throws RDException if incorrect username/pw
     * @return String $response a response saying the student/admin obj has been located. echo their ID.
     */
    public function login($userName, $password)
    {
        // TODO: Implement login() method.
    }

    /**
     * Destroy the user's session.
     *
     * @return void
     */
    public function logout()
    {
        // TODO: Implement logout() method.
    }

    /**
     * @param Entity\TeamImpl A model team whose attributes will be used as a template to query a set of teams from the sys.
     * @return Persistence\TeamIterator An iterator of all teams that match the attributes of the modelTeam
     * or null if none found
     */
    public function findTeam($modelTeam)
    {
        // TODO: Implement findTeam() method.
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\LeagueImpl $modelLeague
     * @return Persistence\LeagueIterator or null
     */
    public function findLeague($modelLeague)
    {
        // TODO: Implement findLeague() method.
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\studentImpl $modelStudent
     * @return Persistence\StudentIterator or null
     */
    public function findStudent($modelStudent)
    {
        // TODO: Implement findStudent() method.
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\AdministratorImpl $modelAdmin
     * @return Persistence\AdministratorIterator or null
     */
    public function findAdmin($modelAdmin)
    {
        // TODO: Implement findAdmin() method.
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\SportsVenueImpl $modelSportsVenue
     * @return Persistence\SportsVenueIterator or null
     */
    public function findSportVenue($modelSportsVenue)
    {
        // TODO: Implement findSportVenue() method.
    }

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
    public function createStudent($firstName, $lastName, $userName, $password, $emailAddress, $studentId, $major, $address)
    {
        // TODO: Implement createStudent() method.
    }

    /**
     * Create a team in the system that is part of a league and contains a team captain.
     *
     * @param Entity\TeamImpl $teamName
     * @param Entity\StudentImpl $student
     * @param Entity\LeagueImpl $league
     * @throws RDException if team name already exists or one of the parameters is null
     * @return int $teamId The ID of the team obj created.
     */
    public function createTeam($teamName, $student, $league)
    {
        // TODO: Implement createTeam() method.
    }

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
    public function createLeague($name, $leagueRules, $matchRules, $isIndoor, $minTeams, $maxTeams, $minMembers, $maxMembers)
    {
        // TODO: Implement createLeague() method.
    }

    /**
     * @param String $name
     * @param boolean $isIndoor
     * @param String $address
     * @return int
     */
    public function createSportsVenue($name, $isIndoor, $address)
    {
        // TODO: Implement createSportsVenue() method.
    }

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
    public function enterMatchScore($captain, $match, $homeTeamScore, $awayTeamScore)
    {
        // TODO: Implement enterMatchScore() method.
    }

    /**
     * Allow a team captain or admin to schedule a match in the future
     * @param $team
     * @param $match
     * @param $venue
     * @param $date
     * @throws \edu\uga\cs\recdawgs\RDException if date is set in the past.
     * @return \DateTime $date The date the match is set to be played
     */
    public function scheduleMatch($team, $match, $venue, $date)
    {
        // TODO: Implement scheduleMatch() method.
    }

    public function updateUser()
    {
        // TODO: Implement updateUser() method.
    }

    public function updateTeam()
    {
        // TODO: Implement updateTeam() method.
    }

    public function updateLeague()
    {
        // TODO: Implement updateLeague() method.
    }

    public function updateSportsVenue()
    {
        // TODO: Implement updateSportsVenue() method.
    }

    public function resetPassword()
    {
        // TODO: Implement resetPassword() method.
    }

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
    public function joinTeam($teamObj = null, $teamName = null, $studentObj = null, $studentId = -1)
    {
        // TODO: Implement joinTeam() method.
    }

    /**
     * Deletes a user and all their links (i.e. team memberships)
     * if a user is a team captain, it removes them as team captain and an admin has to
     * select a new captain for a team. If the team has only one user, then the team
     * is destroyed also.
     *
     * @param Entity\Student $student The user to be deleted
     * @return void
     */
    public function deleteUser($user)
    {
        // TODO: Implement deleteUser() method. make separate delete admin method
    }

    /**
     * Deletes a sports venue given that there are no matches scheduled there.
     *
     * @param Entity\SportsVenueImpl $venue
     * @throws RDException If matches are scheduled at that venue.
     * @return void
     */
    public function deleteSportsVenue($venue)
    {
        // TODO: Implement deleteSportsVenue() method.
    }

    /**
     * Delete a league and all its teams
     *
     * @param Entity\LeagueImpl $league
     * @return void
     */
    public function deleteLeague($league)
    {
        // TODO: Implement deleteLeague() method.
    }

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
    public function confirmMatchScore($report1, $report2, $match)
    {
        // TODO: Implement confirmMatchScore() method.
    }

    /**
     * resolves match score when 2 score reports differ.
     *
     * @param int $fixedHomeScore
     * @param int $fixedAwayScore
     * @param Entity\MatchImpl $match
     * @throws RDException if match is null or scores are negative
     * @return void
     */
    public function resolveMatchScore($fixedHomeScore, $fixedAwayScore, $match)
    {
        // TODO: Implement resolveMatchScore() method.
    }

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
    public function appointCaptain($teamObj = null, $teamName = null, $studentObj = null, $studentId = -1)
    {
        // TODO: Implement appointCaptain() method.
    }

    /**
     * the Leagues satisfying their conditions are activated and their season schedules are
     * created, organized into Rounds of Matches; a list of inactive Leagues (not satisfying their
     * conditions) is reported
     * @return void
     */
    public function closeEnrollment()
    {
        // TODO: Implement closeEnrollment() method.
    }

    /**
     * Team is set as league winner
     *
     * @param Entity\LeagueImpl $league
     * @param Entity\TeamImpl $team
     * @RDException is thrown if team is not in the league.
     * @return void
     */
    public function selectLeagueWinner($league, $team)
    {
        // TODO: Implement selectLeagueWinner() method.
    }

    function __construct()
    {
        // TODO: Implement __construct() method.
    }
}