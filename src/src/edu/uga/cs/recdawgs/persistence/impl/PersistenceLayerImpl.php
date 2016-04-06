<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\PersistenceLayer as PersistenceLayer;

class PersistenceLayerImpl implements PersistenceLayer{
    private $dbConnection = null;
    private $objLayer = null;

    /**
     * @param $dbConnection \PDO
     * @param $objLayer Object\ObjectLayerImpl
     */
    function __construct($dbConnection, $objLayer)
    {
        $this->dbConnection = $dbConnection;
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

        $q = 'SELECT * from ' . DB_NAME. '.user WHERE 1=1 ;';
        if($modelAdministrator != NULL) {
            if ($attr = $modelAdministrator->getFirstName() != NULL) {
                $q .= ' AND first_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getLastName() != NULL) {
                $q .= ' AND last_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getUserName() != NULL) {
                $q .= ' AND user_name = ' . $attr;
            }
            if ($attr = $modelAdministrator->getPassword() != NULL) {
                $q .= ' AND password = ' . $attr;
            }
            if ($attr = $modelAdministrator->getEmailAddress() != NULL) {
                $q .= ' AND email_address = ' . $attr;
            }
            //if ($attr = $modelAdministrator->getId() != NULL){
            //    $q .= 'AND user_id = ' . $attr;
            //}
        }
        $stmt = $this->dbConnection->prepare($q);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return new AdministratorIterator($resultSet, $this->objLayer);
        }
        else{
            throw new RDException('Error restoring administrator model');
        }

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
        //create Query
        $q = "INSERT INTO team10.user (first_name, last_name, user_name, password, email_address, user_type)
              VALUES(?, ?, ?, ?, ?, 1)
              ON DUPLICATE KEY UPDATE
              first_name = VALUES(first_name),
              last_name = VALUES(last_name),
              user_name = VALUES(user_name),
              password = VALUES(password),
              email_address = VALUES(email_address),
              student_id=VALUES(student_id),
              address = VALUES(address),
              major= VALUES(major);";
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $administrator->getFirstName(), \PDO::PARAM_STR);
        $stmt->bindParam(2, $administrator->getLastName(), \PDO::PARAM_STR);
        $stmt->bindParam(3, $administrator->getUserName(), \PDO::PARAM_STR);
        $stmt->bindParam(4, $administrator->getPassword(), \PDO::PARAM_STR);
        $stmt->bindParam(5, $administrator->getEmailAddress(), \PDO::PARAM_STR);
        if($stmt->execute()){
            echo 'Administrator created successfully';
        }
        else{
            throw new RDException('Error creating or updating Administrator');
        }
    }

    /**
     * Delete a given Administrator object from the persistent data store.
     * @param Entity\UserImpl $administrator the Administrator to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function  deleteAdministrator($administrator)
    {
        //Prepare mySQL query
        $q = 'DELETE FROM ' . DB_NAME . '.user WHERE user_id = ?;';
        //create Prepared statement
        $stmt = $this->dbConnection->prepare($q);
        //bind parameter to query
        $stmt->bindParam(1, $administrator->getId(), \PDO::PARAM_INT);
        //execute query
        if ($stmt->execute()) {
            echo 'Administrator deleted successfully';
        }
        else{
            throw new RDException('Deletion of Admin successful');
        }
    }

    /**
     * Restore all Student objects that match attributes of the model Student.
     * @param modelStudent the model Student; if null is provided, all Student objects will be returned
     * @return an Iterator of the located Student objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function  restoreStudent($modelStudent)
    {
        // TODO: Implement restoreStudent() method.
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
        // TODO: Implement storeStudent() method.
    }

    /**
     * Delete a given Student object from the persistent data store.
     * @param student the Student to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteStudent($student)
    {
        // TODO: Implement deleteStudent() method.
    }

    /**
     * Restore all Match objects that match attributes of the model Match.
     * @param modelMatch the model Match; if null is provided, all Match objects will be returned
     * @return an Iterator of the located Match objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreMatch($modelMatch)
    {
        // TODO: Implement restoreMatch() method.
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
        // TODO: Implement storeMatch() method.
    }

    /**
     * Delete a given Match object from the persistent data store.
     * @param match the Match to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteMatch($match)
    {
        // TODO: Implement deleteMatch() method.
    }

    /**
     * Restore all SportsVenue objects that match sportsVenue attributes of the model SportsVenue.
     * @param modelSportsVenue the model SportsVenue; if null is provided, all SportsVenue objects will be returned
     * @return an Iterator of the located SportsVenue objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreSportsVenue($modelSportsVenue)
    {
        // TODO: Implement restoreSportsVenue() method.
    }

    /**
     * Store a given SportsVenue object in the persistent data store.
     * If the SportsVenue object to be stored is already persistent, the persistent
     * object in the data store is updated.
     * @param sportsVenue the SportsVenue to be stored
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeSportsVenue($sportsVenue)
    {
        // TODO: Implement storeSportsVenue() method.
    }

    /**
     * Delete a given SportsVenue object from the persistent data store.
     * @param sportsVenue the SportsVenue to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteSportsVenue($sportsVenue)
    {
        // TODO: Implement deleteSportsVenue() method.
    }

    /**
     * Restore all Team objects that match team attributes of the model Team.
     * @param modelTeam the model Team; if null is provided, all Team objects will be returned
     * @return an Iterator of the located Team objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreTeam($modelTeam)
    {
        // TODO: Implement restoreTeam() method.
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
        // TODO: Implement storeTeam() method.
    }

    /**
     * Delete a given Team object from the persistent data store.
     * @param team the Team to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeam($team)
    {
        // TODO: Implement deleteTeam() method.
    }

    /**
     * Restore all League objects that match league attributes of the model League.
     * @param modelLeague the model League; if null is provided, all League objects will be returned
     * @return an Iterator of the located League objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreLeague($modelLeague)
    {
        // TODO: Implement restoreLeague() method.
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
        // TODO: Implement storeLeague() method.
    }

    /**
     * Delete a given League object from the persistent data store.
     * @param league the League to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeague($league)
    {
        // TODO: Implement deleteLeague() method.
    }

    /**
     * Restore all ScoreReport objects that match modelScoreReport attributes of the model ScoreReport.
     * @param modelScoreReport the model ScoreReport; if null is provided, all ScoreReport objects will be returned
     * @return an Iterator of the located ScoreReport objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreScoreReport($modelScoreReport)
    {
        // TODO: Implement restoreScoreReport() method.
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
        // TODO: Implement storeScoreReport() method.
    }

    /**
     * Delete a given ScoreReport object from the persistent data store.
     * @param scoreReport the ScoreReport to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteScoreReport($scoreReport)
    {
        // TODO: Implement deleteScoreReport() method.
    }

    /**
     * Restore all Round objects that match modelRound attributes of the model Round.
     * @param modelRound the model Round; if null is provided, all Round objects will be returned
     * @return an Iterator of the located Round objects
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreRound($modelRound)
    {
        // TODO: Implement restoreRound() method.
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
        // TODO: Implement storeRound() method.
    }

    /**
     * Delete a given Round object from the persistent data store.
     * @param round the Round to be deleted
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteRound($round)
    {
        // TODO: Implement deleteRound() method.
    }

    /**
     * Store a link between a Student and a Team captained by the Student.
     * @param Entity\UserImpl $student the Student to be linked
     * @param Entity\TeamImpl $team the Team to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeStudentCaptainOfTeam($student, $team)
    {
        $q = 'UPDATE team SET captain_id = ? WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $student->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo $student->getUserName() . ' successfully added as team captain of: ' . $team->getName();
        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully added as team captain of: ' . $team->getName());
        }
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
        // TODO: Implement restoreStudentCaptainOfTeam() method.
    }

    /**
     * Delete a link between a Student and a Team captained by the Student.
     * @param student the Student
     * @param team the Team
     * @throws RDException in case an error occurred during the delete operation
     */
    public function  deleteStudentCaptainOfTeam($student, $team)
    {
        // TODO: Implement deleteStudentCaptainOfTeam() method.
    }

    /**
     * Store a link between a Student and a Team of which the Student is a member.
     * @param student the Student to be linked
     * @param team the Team to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeStudentMemberOfTeam($student, $team)
    {
        // TODO: Implement storeStudentMemberOfTeam() method.
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
        // TODO: Implement restoreStudentMemberOfTeam() method.
    }

    /**
     * Delete a link between a Student and a Team of which the Student is a member.
     * @param student the Student
     * @param team the Team
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteStudentMemberOfTeam($student, $team)
    {
        // TODO: Implement deleteStudentMemberOfTeam() method.
    }

    /**
     * Store a link between a Team and a Match in which the team is the home team.
     * @param team the Team to be linked
     * @param match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function  storeTeamHomeTeamMatch($team, $match)
    {
        // TODO: Implement storeTeamHomeTeamMatch() method.
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
        $q = 'SELECT * FROM ';
        //$team is set, return the match
        if($team != null){
            $q .= 'match WHERE home_team_id = ?;';
        }
        // else match is set, return the team
        else{
            //TODO
            $q .= 'team WHERE match_id = ?';
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
        // TODO: Implement deleteTeamHomeTeamMatch() method.
    }

    /**
     * Store a link between a Team and a Match in which the team is the away team.
     * @param team the Team to be linked
     * @param match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamAwayTeamMatch($team, $match)
    {
        // TODO: Implement storeTeamAwayTeamMatch() method.
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
        // TODO: Implement restoreTeamAwayTeamMatch() method.
    }

    /**
     * Delete a link between a Team and a Match in which the team is the away team.
     * @param team the Team
     * @param match the Match
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamAwayTeamMatch($team, $match)
    {
        // TODO: Implement deleteTeamAwayTeamMatch() method.
    }

    /**
     * Store a link between a Team and a League in which the team participates.
     * @param team the Team to be linked
     * @param league the League to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamParticipatesInLeague($team, $league)
    {
        // TODO: Implement storeTeamParticipatesInLeague() method.
    }

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
    public function restoreTeamParticipatesInLeague($team = null,$league=null)
    {
        // TODO: Implement restoreTeamParticipatesInLeague() method.
    }

    /**
     * Delete a link between a Team and a League in which the team participates.
     * @param team the Team
     * @param league the League
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamParticipatesInLeague($team, $league)
    {
        // TODO: Implement deleteTeamParticipatesInLeague() method.
    }

    /**
     * Store a link between a Team and a League for which the team is the winner.
     * @param team the Team to be linked
     * @param league the League to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeTeamWinnerOfLeague($team, $league)
    {
        // TODO: Implement storeTeamWinnerOfLeague() method.
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
        // TODO: Implement restoreTeamWinnerOfLeague() method.
    }

    /**
     * Delete a link between a Team and a League won by the Team.
     * @param team the Team
     * @param league the League
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteTeamWinnerOfLeague($team, $league)
    {
        // TODO: Implement deleteTeamWinnerOfLeague() method.
    }

    /**
     * Store a link between a League and a SportsVenue used by the league.
     * @param league the League to be linked
     * @param sportsVenue the SportsVenue to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeLeagueSportsVenue($league, $sportsVenue)
    {
        // TODO: Implement storeLeagueSportsVenue() method.
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
        // TODO: Implement restoreLeagueSportsVenue() method.
    }

    /**
     * Delete a link between a League and a SportsVenue used by the league.
     * @param league the League
     * @param sportsVenue the SportsVenue
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeagueSportsVenue($league, $sportsVenue)
    {
        // TODO: Implement deleteLeagueSportsVenue() method.
    }

    /**
     * Store a link between a League and a Round of matches in the league.
     * @param league the League to be linked
     * @param round the Round to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeLeagueRound($league, $round)
    {
        // TODO: Implement storeLeagueRound() method.
    }

    /**
     * Return Rounds of matches for a given League.
     * @param league the League
     * @return an Iterator with all Rounds of matches in the League
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreLeagueRound($league)
    {
        // TODO: Implement restoreLeagueRound() method.
    }

    /**
     * Delete a link between a League and a Round of matches in the league.
     * @param league the League
     * @param round the Round
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteLeagueRound($league, $round)
    {
        // TODO: Implement deleteLeagueRound() method.
    }

    /**
     * Store a link between a Round and a Match to be played in the Round.
     * @param round the Round to be linked
     * @param match the Match to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeRoundMatch($round, $match)
    {
        // TODO: Implement storeRoundMatch() method.
    }

    /**
     * Return Matches played in a given Round.
     * @param round the Round
     * @return an Iterator with all matches played in the round
     * @throws RDException in case an error occurred during the restore operation
     */
    public function restoreRoundMatch($round)
    {
        // TODO: Implement restoreRoundMatch() method.
    }

    /**
     * Delete a link between a Round and a Match to be played in the Round.
     * @param round the Round
     * @param match the Match
     * @throws RDException in case an error occurred during the store operation
     */
    public function  deleteRoundMatch($round, $match)
    {
        // TODO: Implement deleteRoundMatch() method.
    }

    /**
     * Store a link between a Match and a SportsVenue used in the match.
     * @param match the Match to be linked
     * @param sportsVenue the SportsVenue to be linked
     * @throws RDException in case an error occurred during the store operation
     */
    public function storeMatchSportsVenue($match, $sportsVenue)
    {
        // TODO: Implement storeMatchSportsVenue() method.
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
        // TODO: Implement restoreMatchSportsVenue() method.
    }

    /**
     * Delete a link between a Match and a SportsVenue used in the match.
     * @param match the Match
     * @param sportsVenue the SportsVenue
     * @throws RDException in case an error occurred during the delete operation
     */
    public function deleteMatchSportsVenue($match, $sportsVenue)
    {
        // TODO: Implement deleteMatchSportsVenue() method.
    }


}