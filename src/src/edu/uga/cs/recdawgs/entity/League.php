<?php

//package edu.uga.cs.recdawgs.entity;

//import edu.uga.cs.recdawgs.RDException;
//import edu.uga.cs.recdawgs.persistence.Persistable;

/** This class represents a sports league in the RecDawgs system.  A league has a name (which must be unique), league rules
 * match rules, as well as the minimum and maximum number of participating teams (the maximum number must not be less than the minimum).  Furthermore,
 * each team in a league has a minimum and maximum number of team members (the maximum number must not be less than the minimum). The number of
 * teams and team members must be positive.
 *
 */
public interface League extends Persistable
{
    /** Return the name of this league.
     * @return the name of this league
     */
    public function getName();
    
    /** Set the new name of this league.
     * @param name the new name of this league
     */
    public function setName( $name ); 
    
    /** Return the rules of this league.
     * @return the rules of this league
     */
    public function getLeagueRules();
    
    /** Set the new rules of this league.
     * @param leagueRules the new rules of this league
     */
    public function setLeagueRules( $leagueRules );

    /** Return the match rules of this league.
     * @return the match rules of this league
     */
    public function getMatchRules();
    
    /** Set the new match rules of this league.
     * @param matchRules the new match rules of this league
     */
    public function setMatchRules( $matchRules );
    
    /** Return the indoor status of this league.
     * @return the indoor status of this league
     */
    public function getIsIndoor();
    
    /** Set the new indoor status of this league
     * @param isIndoor the new indoor status of this league
     */
    public function setIsIndoor( $isIndoor );
    
    /** Return the minimum number of teams in this league.
     * @return the minimum number of teams in this league
     */
    public function getMinTeams();

    /** Set the new minimum number of teams in this league.
     * @param minTeams the new minimum number of teams in this league
     * @throws RDException in case minTeams is not positive
     */
    public function setMinTeams( $minTeams ); //throws RDException; 

    /** Return the maximum number of teams in this league.
     * @return the maximum number of teams in this league
     */
    public function getMaxTeams();

    /** Set the new maximum number of teams in this league.
     * @param maxTeams the new maximum number of teams in this league
     * @throws RDException in case maxTeams is not positive or less than the current minimum number of teams for this league
     */
    public function setMaxTeams( $maxTeams ); //throws RDException;

    /** Return the minimum number of team players in this league.
     * @return the minimum number of team players in this league
     */
    public function getMinMembers();

    /** Set the new minimum number of team players in this league
     * @param minMembers the new minimum number of team players in this league
     * @throws RDException in case minMembers is not positive
     */
    public function setMinMembers( $minMembers );// throws RDException;

    /** Return the maximum number of team players in this league.
     * @return the maximum number of team players in this league
     */
    public function getMaxMembers();

    /** Set the new maximum number of team players in this league
     * @param maxMembers the new maximum number of team players in this league
     * @throws RDException in case maxMembers is not positive or less than the current minimum number of team players for this league
     */
    public function setMaxMembers( $maxMembers ); // throws RDException; 
      
    /** Return the the winner of this league.
     * @return the team which is the winner of this league
     */
    public function getWinnerOfLeague(); //returns Team
    
    /** Set the league winner.
     * @param team which is this league's winner
     * @throws RDException in case the team is null or the team is not participating in this league
     */
    public function setWinnerOfLeague( Team team ); // throws RDException;
    
    
}

?>