<?php
namespace edu\uga\cs\recdawgs\entity\impl;
use edu\uga\cs\recdawgs\entity\League as League;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;


/** This class represents a sports league in the RecDawgs system.  A league has a name (which must be unique), league rules
 * match rules, as well as the minimum and maximum number of participating teams (the maximum number must not be less than the minimum).  Furthermore,
 * each team in a league has a minimum and maximum number of team members (the maximum number must not be less than the minimum). The number of
 * teams and team members must be positive.
 *
 */

class LeagueImpl extends Persistent implements League {
    private $name = null;
    private $leagueRules = null;
    private $matchRules = null;
    private $isIndoor = null;
    private $minTeams = null;
    private $maxTeams = null;
    private $minMembers = null;
    private $maxMembers = null;
    private $winnerOfLeague = null;
    
    public function __constructor($name=null, $leagueRules=null, $matchRules=null, $isIndoor=null, $minTeams=null, $maxTeams=null, $minMembers=null, $maxMembers=null, $winnerOfLeague=null) {
        $this->name = $name;
        $this->leagueRules = $leagueRules;
        $this->matchRules = $matchRules;
        $this->isIndoor = $isIndoor;
        $this->minTeams = $minTeams;
        $this->maxTeams = $maxTeams;
        $this->minMembers = $minMembers;
        $this->maxMembers = $maxMembers;
        $this->winnerOfLeague = $winnerOfLeague;
        
    }
    
    /** Return the name of this league.
     * @return the name of this league
     */
    public function getName() {
        return $this->name;   
    }
    
    /** Set the new name of this league.
     * @param name the new name of this league
     */
    public function setName( $name ) {
        $this->name = $name;   
    }
    
    /** Return the rules of this league.
     * @return the rules of this league
     */
    public function getLeagueRules() {
        return $this->leagueRules;   
    }
    
    /** Set the new rules of this league.
     * @param leagueRules the new rules of this league
     */
    public function setLeagueRules( $leagueRules ){
        $this->leagueRules = $leagueRules;   
    }

    /** Return the match rules of this league.
     * @return the match rules of this league
     */
    public function getMatchRules() {
        return $this->matchRules;   
    }
    
    /** Set the new match rules of this league.
     * @param matchRules the new match rules of this league
     */
    public function setMatchRules( $matchRules ) {
        $this->matchRules = $matchRules;   
    }
    
    /** Return the indoor status of this league.
     * @return the indoor status of this league
     */
    public function getIsIndoor() {
        return $this->isIndoor;   
    }
    
    /** Set the new indoor status of this league
     * @param isIndoor the new indoor status of this league
     */
    public function setIsIndoor( $isIndoor ) {
        $this->isIndoor = $isIndoor;       
    }
    
    /** Return the minimum number of teams in this league.
     * @return the minimum number of teams in this league
     */
    public function getMinTeams() {
         return $this->minTeams;  
    }

    /** Set the new minimum number of teams in this league.
     * @param minTeams the new minimum number of teams in this league
     * @throws RDException in case minTeams is not positive
     */
    public function setMinTeams( $minTeams ) { //throws RDException; 
        if($minTeams < 0) {
            throw new RDException('Min teams can not be null');
        } else {
            $this->minTeams = $minTeams; 
        }
    }
    /** Return the maximum number of teams in this league.
     * @return the maximum number of teams in this league
     */
    public function getMaxTeams() {
        return $this->maxTeams;   
    }

    /** Set the new maximum number of teams in this league.
     * @param maxTeams the new maximum number of teams in this league
     * @throws RDException in case maxTeams is not positive or less than the current minimum number of teams for this league
     */
    public function setMaxTeams( $maxTeams ) { //throws RDException;
        if($maxTeams < 0 || $maxTeams < $this->minTeams) {
            throw new RDException('Max teams cannot be smaller than the minimum number of teams or negative.');
        } else {
            $this->maxTeams = $maxTeams;
        }
    }
    /** Return the minimum number of team players in this league.
     * @return the minimum number of team players in this league
     */
    public function getMinMembers() {
        return $this->minMembers;   
    }

    /** Set the new minimum number of team players in this league
     * @param minMembers the new minimum number of team players in this league
     * @throws RDException in case minMembers is not positive
     */
    public function setMinMembers( $minMembers ) {// throws RDException;
        if($minMembers < 0) {
            throw new RDException('Min number of members of a team cannot be negative.');
        } else {
            $this->minMembers = $minMembers;

        }
    }
    /** Return the maximum number of team players in this league.
     * @return the maximum number of team players in this league
     */
    public function getMaxMembers() {
        return $this->maxMembers;   
    }

    /** Set the new maximum number of team players in this league
     * @param maxMembers the new maximum number of team players in this league
     * @throws RDException in case maxMembers is not positive or less than the current minimum number of team players for this league
     */
    public function setMaxMembers( $maxMembers ) { // throws RDException; 
     
        if($maxMembers < 0 || $maxMembers < $this->minMembers) {
            throw new RDException('Max number of members of a team cannot be smaller than the min number of teams or negative.');   
        } else {
            $this->maxMembers = $maxMembers;
        }
    }
    /** Return the the winner of this league.
     * @return the team which is the winner of this league
     */
    public function getWinnerOfLeague() { //returns Team
        return $this->winnerOfLeague;
    }
    /** Set the league winner.
     * @param team which is this league's winner
     * @throws RDException in case the team is null or the team is not participating in this league
     */
    public function setWinnerOfLeague($team ) { // throws RDException;
        if(!isset($team)) {
            throw new RDException('Winner of league cannot be null');
        }

        $this->winnerOfLeague = $team;
    }
    
}

