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
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\RDException;

class LogicLayerImpl implements LogicLayer{

    private $objectLayer = null;

    function __construct($objectLayer=null, $dbConnection=null)
    {
        if ($objectLayer != null) {
            $this->objectLayer = $objectLayer;
        }
        else  {
            $dbConnection = new Persistence\DbConnection();
            $objectLayer = new Object\ObjectLayerImpl();
            $persistenceLayer = new Persistence\PersistenceLayerImpl($dbConnection, $objectLayer);
            $objectLayer->setPersistence($persistenceLayer);
            $this->objectLayer = $objectLayer;
        }

    }

    /**
     * @param String $userName
     * @param String $password
     * @throws RDException if incorrect username/pw
     * @return Entity\StudentImpl the student obj
     */
    public function login($userName, $password)
    {

        $modelStudent = new Entity\StudentImpl();
        $modelStudent->setUserName($userName);
        $modelStudent->setPassword($password);
        $studentIter = $this->objectLayer->findStudent($modelStudent);
        if($studentIter->size() <= 0){
            throw new RDException($string="Username or Password incorrect");
        }
        else{
            return $studentIter->current();
        }
    }

    /**
     * Destroy the user's session.
     *
     * @return void
     */
    public function logout()
    {
        // TODO: Implement logout() method.
        //handle this in presentation layer
    }

    /**
     * @param Entity\TeamImpl A model team whose attributes will be used as a template to query a set of teams from the sys.
     * @return Persistence\TeamIterator An iterator of all teams that match the attributes of the modelTeam
     * or null if none found
     */
    public function findTeam($modelTeam=null, $teamId=-1)
    {
        if($modelTeam!=null){
            return $this->objectLayer->findTeam($modelTeam);
        }
        else if($teamId > -1){
            $modelTeam = $this->objectLayer->createTeam();
            $modelTeam->setId($teamId);
            return $this->objectLayer->findTeam($modelTeam);
        }
        return null;
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\LeagueImpl $modelLeague
     * @return Persistence\LeagueIterator or null
     */
    public function findLeague($modelLeague=null, $leagueId=-1)
    {
        //return $this->objectLayer->findLeague($modelLeague);
        if($modelLeague) {
            return $this->objectLayer->findLeague($modelLeague);
        }
        else if($leagueId > -1){
            $modelLeague = $this->objectLayer->createLeague();
            $modelLeague->setId($leagueId);
            return $this->objectLayer->findLeague($modelLeague);
        }
        return null;

    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\studentImpl $modelStudent
     * @return Persistence\StudentIterator or null
     */
    public function findStudent($modelStudent=null, $studentId=-1)
    {
        if($modelStudent !=null ) {
            return $this->objectLayer->findStudent($modelStudent);
        }
        else if($studentId > -1){
            $modelStudent = $this->objectLayer->createStudent();
            $modelStudent->setId($studentId);
            return $this->objectLayer->findStudent($modelStudent);

        }
        else{
            return null;
        }
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\AdministratorImpl $modelAdmin
     * @return Persistence\AdministratorIterator or null
     */
    public function findAdmin($modelAdmin)
    {
        return $this->objectLayer->findAdministrator($modelAdmin);
    }

    /**
     * @see LogicLayer::findTeam 's doc
     *
     * @param Entity\SportsVenueImpl $modelSportsVenue
     * @return Persistence\SportsVenueIterator or null
     */
    public function findSportVenue($modelSportsVenue)
    {
        return $this->objectLayer->findSportsVenue($modelSportsVenue);
    }

    public function findTeamsIsMemberOf($student=null, $studentId=-1){

        if ($student != null) {
            return $this->objectLayer->restoreStudentMemberOfTeam($student, null);
        }
        else if($studentId > -1){
            $modelStudent = $this->objectLayer->createStudent();
            $modelStudent->setId($studentId);
            $student = $this->objectLayer->findStudent($modelStudent)->current();
            return $this->objectLayer->restoreStudentMemberOfTeam($student, null);
        }
        else return null;
    }

    public function findMembersOfTeam($team=null, $teamId = -1){
        if($team != null){
            return $this->objectLayer->restoreStudentMemberOfTeam(null, $team);
        }
        else if($teamId > -1){
            $modelTeam = $this->objectLayer->createTeam();
            $modelTeam->setId($teamId);
            $team = $this->objectLayer->findTeam($modelTeam)->current();
            return (isset($team)) ? $this->objectLayer->restoreStudentMemberOfTeam(null, $team) : null;
        }
        return null;
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
        if($firstName==null || $lastName==null || $userName==null || $password==null ||  $emailAddress==null || $studentId==null || $major==null || $address==null)
            throw new RDException("Parameters can not be null.");
        
        $student = $this->objectLayer->createStudent(
            $firstName,
            $lastName,
            $userName,
            $password,
            $emailAddress,
            $studentId,
            $major,
            $address
        );

        $this->objectLayer->storeStudent($student);
        return $student->getId();

    }

    /**
     * Create a team in the system that is part of a league and contains a team captain.
     *
     * @param Entity\TeamImpl $teamName
     * @param Entity\StudentImpl $student
     * @param Entity\LeagueImpl $league
     * @throws RDException if team name already exists or one of the parameters is null or league is full
     * @return int $teamId The ID of the team obj created.
     */
    public function createTeam($teamName, $student, $league)
    {
        if($teamName==null || $student == null || $league == null)
            throw new RDException("Parameters can not be null.");
        //check if league is full
        $teamIter = $this->objectLayer->restoreTeamParticipatesInLeague(null, $league);
        if($teamIter->size() >= $league->getMaxTeams()){
            throw new RDException("League is full");
        }

        $team = $this->objectLayer->createTeam($teamName, $student, $league);
        $this->objectLayer->storeTeam($team);
        return $team->getId();
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
        if($name==null ||  $leagueRules==null ||  $matchRules==null ||  $isIndoor==null ||  $minTeams==null ||  $maxTeams==null ||  $minMembers==null ||  $maxMembers==null)
            throw new RDException("Parameters can not be null.");

        $league = $this->objectLayer->createLeague(
            $name,
            $leagueRules,
            $matchRules,
            $isIndoor,
            $minTeams,
            $maxTeams,
            $minMembers,
            $maxMembers
        );
        $this->objectLayer->storeLeague($league);

        return $league->getId();
    }

    /**
     * @param String $name
     * @param boolean $isIndoor
     * @param String $address
     * @throws RDException if venue name already exists or one of the parameters is null
     * @return int
     */
    public function createSportsVenue($name, $isIndoor, $address)
    {
        if($name==null || $isIndoor==null || $address==null){
            throw new RDException("Parameters can not be null");
        }

        $venue = $this->objectLayer->createSportsVenue($name,$address, $isIndoor);
        $this->objectLayer->storeSportsVenue($venue);

        return $venue->getId();
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
        if($captain == null || $match == null || $homeTeamScore < 0 || $awayTeamScore < 0){
            throw new RDException($string="check params");
        }

        //first check if there are already 2 score reports for this match.
        $modelScoreReport = new Entity\ScoreReportImpl();
        $modelScoreReport->setMatch($match);
        //returns iter of all reports of this match
        $scoreReportIter = $this->objectLayer->findScoreReport($modelScoreReport);

        if($scoreReportIter->size() >= 2){
            throw new RDException($string="There's already 2 score reports for this match.");
        }

        //now create it.
        $date = new \DateTime(date('Y-m-d H:i:s', time()));
        $scoreReport = $this->objectLayer->createScoreReport($homeTeamScore, $awayTeamScore, $date, $captain, $match);
        $this->objectLayer->storeScoreReport($scoreReport);

        if($scoreReportIter->size() == 1){
            $this->confirmMatchScore($scoreReportIter->current(), $scoreReport, $match);
        }

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

    public function updateUser($firstName=null, $lastName=null, $userName=null, $password=null, $emailAddress=null,$studentId=null, $major=null, $address=null)
    {
        //we have to assume that they are logged in
        $ourStudent = $_SESSION['userObject'];
        if($firstName!=null){
            $ourStudent->setFirstName($firstName);
        }
        if($lastName != null) {
            $ourStudent->setLastName($lastName);
        }
        if($userName != null) {
            $ourStudent->setUserName($userName);
        }
        if($password != null) {
            $ourStudent->setPassword($password);
        }
        if($emailAddress != null) {
            $ourStudent->setEmailAddress($emailAddress);
        }
        if($studentId != null) {
            $ourStudent->setStudentId($studentId);
        }
        if($major != null) {
            $ourStudent->setMajor($major);
        }
        if($address != null) {
            $ourStudent->setAddress($address);
        }
        $this->objectLayer->storeStudent($ourStudent);

    }

    public function updateTeam($teamName, $newName=null, $teamCaptain=null, $league=null, $winnerOfLeague=null)
    {
        $teamModel = new Entity\TeamImpl();
        $teamModel->setName($teamName);
        $teamIter = $this->objectLayer->findTeam($teamModel);

        if($teamIter->size() <= 0) {
            throw new RDException("Team not found");
        } else {
            $team = $teamIter->current();
            if($newName != null) {
                $team->setName($newName);
            }
            if($teamCaptain != null) {
                $team->setCaptain($teamCaptain);
            }
            if($league != null) {
                $team->setParticipatesInLeague($league);
            }
            if($winnerOfLeague != null) {
                $team->setWinnerOfLeague($winnerOfLeague);
            }

            //updates team
            $this->objectLayer->storeTeam($team);
        }
    }

    public function updateLeague($leagueName, $newName=null, $leagueRules=null, $matchRules=null, $isIndoor=null, $minTeams=null, $maxTeams=null, $minMembers=null, $maxMembers=null, $winnerOfLeague=null)
    {
        $leagueModel = new Entity\LeagueImpl();
        $leagueModel->setName($leagueName);
        $leagueIter = $this->objectLayer->findLeague($leagueModel);

        if($leagueIter->size() <= 0){
            throw new RDException($string="League not found");
        }
        else{
            $league = $leagueIter->current();
            if($newName != null){
                $league->setName($newName);
            }
            if($leagueRules != null) {
                $league->setLeagueRules($leagueRules);
            }
            if($matchRules != null) {
                $league->setMatchRules($matchRules);
            }
            if($isIndoor != null) {
                $league->setIsIndoor($isIndoor);
            }
            if($minTeams != null) {
                $league->setMinTeams($minTeams);
            }
            if($maxTeams != null) {
                $league->setMaxTeams($maxTeams);
            }
            if($minMembers != null) {
                $league->setMinMembers($minMembers);
            }
            if($maxMembers != null) {
                $league->setMaxMembers($minMembers);
            }
            if($winnerOfLeague != null) {
                $league->setWinnerOfLeague($winnerOfLeague);
            }


            $this->objectLayer->storeLeague($league);
        }
    }

    public function updateSportsVenue($venueName, $newName=null, $isIndoor=null, $address=null)
    {
        $sportsVenueModel = new Entity\SportsVenueImpl();
        $sportsVenueModel->setName($venueName);
        $sportsVenueIter = $this->objectLayer->findSportsVenue($sportsVenueModel);

        if($sportsVenueIter->size() <= 0) {
            throw new RDException("Sports Venue not found");
        } else {
            $sportsVenue = $sportsVenueIter->current();
            if($newName != null) {
                $sportsVenue->setName($newName);
            }
            if($isIndoor != null) {
                $sportsVenue->setIsIndoor($isIndoor);
            }
            if($address != null) {
                $sportsVenue->setAddress($address);
            }
            $this->objectLayer->storeSportsVenue($sportsVenue);
        }

    }

    public function resetPassword($student = null, $admin = null)
    {

        $userIter = null;
        if($student != null) {
            $userIter = $this->objectLayer->findStudent($student);
        } else if ($admin != null) {
            $userIter = $this->objectLayer->findAdministrator($admin);
        } else {
            throw new RDException("Student and admin both null");
        }

        //change user's password and store in database
        if($userIter->size() <=0) {
            throw new RDException("User not found");
        } else {
            $user = $userIter->current();
            $user->setPassword($this->getRandomPassword());
            if($student != null) {
                $this->objectLayer->storeStudent($user);
            } else if ($admin != null) {
                $this->objectLayer->storeAdministrator($user);
            }

        }

        //TODO: Send email functionality? (maybe)
        //return $user;

    }


    /**
     * @return string (random password)
     */
    private function getRandomPassword() {
        $charSet = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password = "";
        for($i = 0; $i < 8; $i++) {
            $randNum = rand(0, strlen($charSet)-1);
            $password .= $charSet[$randNum];
        }
        return $password;
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
     * @throws RDException if any parameter is null or if the max number of team members has been reached
     * @return int ID of the team joined
     */
    public function joinTeam($teamObj = null, $teamName = null, $studentObj = null, $studentId = -1)
    {

        if($teamName != null && $studentId > -1){
            //create iter to find student with given id
            $modelStudent = new Entity\StudentImpl();
            $modelStudent->setId($studentId);
            $studentIter = $this->objectLayer->findStudent($modelStudent);
            $studentObj = $studentIter->current();

            //create iter to find team with given team name
            $modelTeam = new Entity\TeamImpl();
            $modelTeam->setName($teamName);
            $teamIter = $this->objectLayer->findTeam($modelTeam);
            $teamObj = $teamIter->current();
        }
        else{
            throw new RDException("Parameters are not correct");
        }

        //check for maximum number of players in the team
        $teamMemberIter = $this->objectLayer->restoreStudentMemberOfTeam($teamObj);
        $leagueIter = $this->objectLayer->restoreTeamParticipatesInLeague($teamObj);
        $league = $leagueIter->current();
        if ($teamMemberIter->size() >= $league->getMaxMembers()) {
            throw new RDException("Maximum number of members has been reached.");
        }

        $this->objectLayer->createStudentMemberOfTeam($studentObj, $teamObj);
    }

    /**
     * Deletes a user and all their links (i.e. team memberships)
     * if a user is a team captain, it removes them as team captain and an admin has to
     * select a new captain for a team. If the team has only one user, then the team
     * is destroyed also.
     *
     * @param Entity\StudentImpl $student The user to be deleted
     * @return void
     */
    public function deleteUser($user)
    {
        // try getting the team info of that user
        $teams = $this->objectLayer->restoreStudentMemberOfTeam($user, null);

        // when the student is not associated with any teams
        if ($teams->size() == 0) {
            $this->objectLayer->deleteStudent($user);
            return;
        }

        // when the student is associated with teams
        $team = $teams->current();
        while ($team != null) {
            $this->deleteUserAndTeam($user, $team);
            $teams->next();
            $team = $teams->current();
        }
    }

    // delete the relationship between user and the team firstly
    // delete the team secondly
    private function deleteUserAndTeam($user, $team) {       
        // if student is a captain of this team
        if ($this->checkCaptain($user, $team)) {
            $members = $this->objectLayer->restoreStudentMemberOfTeam(null, $team);

            // TO DO: matches unclear
            if ($members->size() > 1) {
                $this->objectLayer->deleteStudentCaptainOfTeam($user, $team);
                $this->objectLayer->deleteStudent($user);
            } else {
                $this->objectLayer->deleteStudentCaptainOfTeam($user, $team);
                $this->objectLayer->deleteStudent($user);
            }
            
        } else {
            $this->objectLayer->deleteStudentMemberOfTeam($user, $team);
            $this->objectLayer->deleteStudent($user);
        }
    }

    // check if the user is the captain of the team
    private function checkCaptain($user, $team) {
        // check if this student captains that team
        $teams = $this->objectLayer->restoreStudentCaptainOfTeam($user, null);

        if ($teams->size() == 0) {
            return false;
        }

        $currentTeam = $teams->current();
        while ($currentTeam != null) {
            if (strcmp($currentTeam->getName(), $team-> getName()) == 0) {
                return true;
            }
            $teams->next();
            $currentTeam = $teams->current();
        }

        return false;
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
        // see if there are any associated matches first
        $matches = $this->objectLayer->restoreMatchSportsVenue(null, $venue);
        if ($matches->size() > 0) {
            throw new RDException('Delete failure: There are matches associated with this venue.');
        }

        // see if there are any lassociated leagues secondly
        $leagues = $this->objectLayer->restoreLeagueSportsVenue(null, $venue);
        if ($leagues->size() > 0) {
            throw new RDException('Delete failure: There are leagues associated with this venue.');
        }

        // excute deletion
        $this->objectLayer->deleteSportsVenue($venue);
    }

    /**
     * Delete a league and all its teams
     *
     * @param Entity\LeagueImpl $league
     * @return void
     */
    public function deleteLeague($league)
    {   
        // determine the team numbers of a league
        $teams = $this->objectLayer->restoreTeamParticipatesInLeague(null, $league);
        if ($teams->size() > 0) {
            throw new RDException('Delete failure: There are teams associated with this league.');
        }

        // try deleting all associated sports venue relationship firstly
        $venues = $this->objectLayer->restoreLeagueSportsVenue($league, null);
        $venue = $venues->current();
        while ($venue != null) {
            $this->objectLayer->deleteLeagueSportsVenue($league, $venue);
            $venues->next();
            $venue = $venues->current();
        }

        // try deleting all associated rounds relationship secondly
        $rounds = $this->objectLayer->restoreLeagueRound($league);
        $round = $rounds->current();
        while ($round != null) {
            $this->objectLayer->deleteLeagueRound($league, $round);
            $rounds->next();
            $round = $rounds->current();
        }

        // delete leagues thirdly
        $this->objectLayer->deleteLeague($league);
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
        // TODO: figure out how to notify admin of a dispute
        if(!($report2->getHomePoints() == $report1->getAwayPoints() && $report1->getHomePoints() == $report2->getAwayPoints())){
            throw new RDException($string="There are discrepancies in the two score reports");
        }
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
        $homeTeam = $match->getHomeTeam();
        $awayTeam = $match->getAwayTeam();
        //create empty score report
        $modelScoreReport = $this->objectLayer->createScoreReport();
        $modelScoreReport->setMatch($match);

        //get both score reports for this match
        $scoreReportIter = $this->objectLayer->findScoreReport($modelScoreReport);

        //go through both reports and update the scores
        while($scoreReportIter->current()){
            $scoreReport = $scoreReportIter->current();
            //TODO figure out how to set the currect values of the score reports
            $scoreReportIter->next();
        }
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
     * @throws RDException throw exception if the two conditions are not met
     * @return int ID of the team joined
     */
    public function appointCaptain($teamObj = null, $teamName = null, $studentObj = null, $studentId = -1)
    {
        if($teamObj != null && $studentObj != null){
            $this->objectLayer->createStudentCaptainOfTeam($studentObj, $teamObj);
        }
        else if($teamName != null && $studentId > -1){
            //TODO write 2nd case here
        }
        else{
            throw new RDException("Parameters are null");
        }
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
     * @throws RDException is thrown if team is not in the league.
     * @return void
     */
    public function selectLeagueWinner($league, $team)
    {
        if($team->getParticipatesInLeague()->getName() != $league->getName()){
            throw new RDException($string="Team is not in this league.");
        }
        $this->objectLayer->createTeamWinnerOfLeague($team, $league);
    }


}