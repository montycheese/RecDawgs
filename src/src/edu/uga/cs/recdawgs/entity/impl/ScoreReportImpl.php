<?php
namespace edu\uga\cs\recdawgs\entity\impl;

use edu\uga\cs\recdawgs\entity\ScoreReport as ScoreReport;

use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents a score report for a match between two teams in a sports league.
 * One score report is submitted by each of the two team captains.  If both score reports are
 * the same, the score report becomes official and is recorded in the corresponding Match.
 *
 */

class ScoreReportImpl extends Persistent implements ScoreReport {
    private $homePoint;
    private $awayPoint;
    private $date;
    private $match;
    private $student;
    private $homeTeam;
    private $awayTeam;

    /** Constructor
     * Initalizes all of the parameter values into local variables.
     */
    public function __constructor($homePoint=null, $awayPoint=null, $date=null, $match=null, $student=null) {
        $this->homePoint = $homePoint;
        $this->awayPoint = $awayPoint;
        $this->date = $date;
        $this->match = $match;
        $this->student = $student;
        
        if(isset($match)) {
            $this->homeTeam = $match->getHomeTeam();
            $this->awayTeam = $match->getAwayTeam();
        }
    }
    
    /** Return the points scored by the home team.
     * @return the points scored by the home team
     */
    public function getHomePoints() {
        return $this->homePoint;
    }

    /** Set the points scored by the home team
     * @param homePoints the points scored by the home team
     * @throws RDException in case homePoints is negative
     */
    public function setHomePoints( $homePoints ){// throws RDException;
       // try {
        //Throw Exception if homePoints is negative.
        if($homePoints < 0) {
            throw new RDException('Home Points can not be a negative value.');
        }
        else{
            $this->homePoint = $homePoints;
        }
        //} catch (RDException $rde) {
          //  echo $rde;   
        //}
    }
    /** Return the points scored by the away team.
     * @return the points scored by the away team
     */
    public function getAwayPoints() {
        return $this->awayPoints;   
    }

    /** Set the points scored by the away team
     * @param awayPoints the points scored by the away team
     * @throws RDException in case awayPoints is negative
     */
    public function setAwayPoints( $awayPoints ){ //throws RDException;
        if($awayPoints < 0) {
            throw new RDException('Away Points can not be a negative value.');
        }
        else{
            $this->awayPoints = $awayPoints;
        }
        
    }
    /** Return the date of the match.
     * @return the date of the match
     */
    public function getDate() {
        return $this->date;   
    }

    /** Set the new date of the match
     * @param date the new date of the match
     */
    public function setDate( $date ) {
        $this->date = $date;
    }

    /** Return the match involved in the report.
     * @return the match involved in the report
     */
    public function getMatch() {
        return $this->match;   
    }
    
    /** Set the match involved in the report.
     * @param match the match involved in the report
     * @throws RDException in case the match is null
     */
    public function setMatch( $match ){ // throws RDException;
        if(!isset($match)) {
            throw new RDException('Match can not be null'); 
        }
        else{
            $this->match = $match;
        }
       
    }
    /** Return the student involved in the report.
     * @return the student involved in the report
     */
    public function getStudent() {
        return $this->student;   
    }
    
    /** Set the student involved in the report.
     * @param student the student involved in the report
     * @throws RDException in case the student is null or not the captain of the team involved in the match
     */
    public function setStudent( $student ) { // throws RDException;
        if(!isset($student)) {
            throw new RDException('Student can not be null');
        } else if ((isset($this->homeTeam) && isset($this->awayTeam)) &&($student !== $this->homeTeam->getTeamCaptain()) || ($student !== $this->awayTeam->getTeamCaptain())) {
            throw new RDException('Student has to be a Team Captain');   
        }
        else{
            $this->student = $student;
        }
    
    }
}

?>
