<?php
namespace edu\uga\cs\recdawgs\entity\impl;
use edu\uga\cs\recdawgs\entity\Match as Match;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;


/** This class represents a match between two teams participating in the same sports league.
 * The match is played at a sports venue.
 * The match, once completed, should have a results, which is indicated by the points scored by
 * the home team and the away team (the points must not be negative).
 *
 */

class MatchImpl extends Persistent implements Match {
     private $homePoints;
     private $awayPoints;
     private $date;
     private $isCompleted;
     private $homeTeam;
     private $awayTeam;
     private $sportsVenue;
     private $round;
    
     public function __constructor($homePoints=null, $awayPoints=null, $date=null, $isCompleted=null, $homeTeam=null, $awayTeam=null, $sportsVenue=null, $round=null) {
         $this->homePoints = $homePoints;
         $this->awayPoints = $awayPoints;
         $this->date = $date;
         $this->isCompleted = $isCompleted;
         $this->homeTeam = $homeTeam;
         $this->awayTeam = $awayTeam;
         $this->sportsVenue = $sportsVenue;
         $this->round = $round;

        
    }
     
    /** Return the points scored by the home team.
     * @return the points scored by the home team
    */
    public function getHomePoints() {
        return $this->homePoints;   
    }

    /** Set the points scored by the home team
     * @param homePoints the points scored by the home team
     * @throws RDException in case homePoints is negative
     */
    public function setHomePoints( $homePoints ){ //throws RDException;
        
        if($homePoints < 0) {
            throw new RDException('Home points can not be negative.');   
        } else {
            $this->homePoints = $homePoints;   
        }

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
    public function setAwayPoints( $awayPoints ){ // throws RDException;
        if($awayPoints < 0) {
            throw new RDException('Away points cannot be negative.');   
        } else {
            $this->awayPoints = $awayPoints;
        }
    }
    /** Return the date of the match.
     * @return the date of the match
     */
    public function getDate(){ //returns Date
        return $this->date;
    }
    /** Set the new date of the match
     * @param date the new date of the match
     * @throws RDException in case the date is in the past
     */
    public function setDate( $date ){ // throws RDException
        date_default_timezone_set('America/New_York');

        $datetime_new = new \DateTime($date);
        $datetime_cur = new \DateTime(date('Y-m-d H:i:s', time()));

       if ($datetime_new->diff($datetime_cur)->format('%R') == '+'){
            $this->date = $date;
        }
        else {
            throw new RDException('Date is in the past.');
        }
    }
    /** Return the indication if this match has been completed.
     * @return the indication if this match has been completed
     */
    public function getIsCompleted() {
        return $this->isCompleted;
    }

    /** Set the indication if this match has been completed.
     * @param isCompleted the indication if this match has been completed
     */
    public function setIsCompleted( $isCompleted ){
        $this->isCompleted = $isCompleted;   
    }
    
     
    /** Return the home team of this match.
     * @return the home team of this match
     */
    public function getHomeTeam(){ //return Team
        return $this->homeTeam;
    }

    public function setHomeTeam( $homeTeam ){ // throws RDException;
        if($homeTeam == null || $homeTeam->getParticipatesInLeague() == null) {
            throw new RDException('Home team can not be null.');
        }

        //if($this->awayTeam == null && $this->awayTeam->getParticipatesInLeague() == null) {
         //   throw new RDException('Away Team must be in the same league as the Away Team.');
        //}

        //if (($this->$awayTeam->getParticipatesInLeague()->getId() != $homeTeam->getParticipatesInLeague()->getId())) {
        //    throw new RDException('Teams dont have same league.');
       // }
        $this->homeTeam = $homeTeam;
    }

    /** Set the home team of this match.
     * @param homeTeam the home team of this match
     * @throws RDException in case the homeTeam is null or not participating in the same league as the away team
     */
    public function setHomeTeam2( $homeTeam ){ // throws RDException;
        
        if(!isset($homeTeam)) {
            throw new RDException('Home team can not be null.');
        } else if($this->awayTeam != null && ($homeTeam->getParticipatesInLeague()->getId() != $this->awayTeam->getParticipatesInLeague()->getId())) {
            throw new RDException('Home Team must be in the same league as the Away Team.');   
        }
        else {
            $this->homeTeam = $homeTeam;
        }
    }
    /** Return the away team of this match.
     * @return the away team of this match
     */
    public function getAwayTeam(){ 
        return $this->awayTeam; 
    }

    /** Set the away team of this match.
     * @param awayTeam the away team of this match
     * @throws RDException in case the awayTeam is null or not participating in the same league as the home team
     */
    public function setAwayTeam( $awayTeam ) { // throws RDException;

        if($awayTeam == null  || $awayTeam->getParticipatesInLeague() ==null) {
            throw new RDException('Away team can not be null');
        }
        if ($this->homeTeam == null || $this->homeTeam->getParticipatesInLeague() == null) {
            throw new RDException('Home team can not be null');
        }

        if ($awayTeam->getParticipatesInLeague() == null || $this->homeTeam->getParticipatesInLeague() == null) {
            throw new RDException('One team does not have a league');
        }

        if ($awayTeam->getParticipatesInLeague()->getId() != $this->homeTeam->getParticipatesInLeague()->getId()) {
            throw new RDException('Two teams don\'t have the same league');
        }

        $this->awayTeam = $awayTeam;
    }

    /** Set the away team of this match.
     * @param awayTeam the away team of this match
     * @throws RDException in case the awayTeam is null or not participating in the same league as the home team
     */
    public function setAwayTeam2( $awayTeam ) { // throws RDException;
        echo 'var_dump : ' . var_dump($awayTeam);
        if($awayTeam == null) {
            throw new RDException('Away team can not be null');
        }
        //TODO
        else if($this->homeTeam != null  && $this->homeTeam->getParticipatesInLeague()!=null && $awayTeam->getParticipatesInLeague() !=null &&
            (
                $awayTeam->getParticipatesInLeague()->getId() != $this->homeTeam->getParticipatesInLeague()->getId()
            )
        )
        {
            throw new RDException('Away Team must be in the same league as the Home Team.');   
        }

        else {
            $this->awayTeam = $awayTeam;   
        }
   
    }
    /** Return the sports venue of this match.
     * @return the sports venue of this match
     */
    public function getSportsVenue(){ //returns SportsVenue
        return $this->sportsVenue; 
            
    }
    /** Set the sports venue of this match.
     * @param sportsVenue the sports venue of this match
     */
    public function setSportsVenue( $sportsVenue) {
        $this->sportsVenue = $sportsVenue;
    }

     /**
      * Set the round in which this match is played
      *
      * @param Round $round
      * @return void
      */
     public function setRound($round) {
         $this->round = $round;
     }

    public function getRound(){
        return $this->round;
    }
    
}

?>