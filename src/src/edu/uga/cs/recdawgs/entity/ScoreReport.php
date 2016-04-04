<?php
namespace edu\uga\cs\recdawgs\entity;

use edu\uga\cs\recdawgs\persistence\Persistable as Persistable;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents a score report for a match between two teams in a sports league.
 * One score report is submitted by each of the two team captains.  If both score reports are
 * the same, the score report becomes official and is recorded in the corresponding Match.
 *
 */
 interface ScoreReport
    extends Persistable
{
    /** Return the points scored by the home team.
     * @return the points scored by the home team
     */
    public function getHomePoint();

    /** Set the points scored by the home team
     * @param homePoints the points scored by the home team
     * @throws RDException in case homePoints is negative
     */
    public function setHomePoint( $homePoints );// throws RDException;

    /** Return the points scored by the away team.
     * @return the points scored by the away team
     */
    public function getAwayPoints();

    /** Set the points scored by the away team
     * @param awayPoints the points scored by the away team
     * @throws RDException in case awayPoints is negative
     */
    public function setAwayPoints( $awayPoints ); //throws RDException;

    /** Return the date of the match.
     * @return the date of the match
     */
    public function getDate();

    /** Set the new date of the match
     * @param date the new date of the match
     */
    public function setDate( $date );

    /** Return the match involved in the report.
     * @return the match involved in the report
     */
    public function getMatch();
    
    /** Set the match involved in the report.
     * @param match the match involved in the report
     * @throws RDException in case the match is null
     */
    public function setMatch( $match ); // throws RDException;
    
    /** Return the student involved in the report.
     * @return the student involved in the report
     */
    public function getStudent();
    
    /** Set the student involved in the report.
     * @param student the student involved in the report
     * @throws RDException in case the student is null or not the captain of the team involved in the match
     */
    public function setStudent( $student ); // throws RDException;
    
}

?>