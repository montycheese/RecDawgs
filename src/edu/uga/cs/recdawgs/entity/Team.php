<?php
namespace edu\uga\cs\recdawgs\entity;

use edu\uga\cs\recdawgs\persistence\Persistable as Persistable;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents a recreational sports team, participating in one of the
 * sports leagues.  A team must have a name (which must be unique across all teams) and one student 
 * acting as the team captain.  A team must have a league in which it participates and
 * may become the league winner.
 *
 */
interface Team extends Persistable
{
    /** Return the name of this team.
     * @return a string which is the name of this team
     */
    public function getName();
    
    /** Set the new name for this team.
     * @param name the new name for this team
     * @throws RDException in case a team with the given name already exists
     */
    public function setName($name);
    
    /** Return the team's captain.
     * @return the student who is this team's captain
     */
    public function getCaptain();
    
    /** Set the team's captain.
     * @param student the student who is the new captain of this team
     * @throws RDException in case the student is null
     */
    public function setCaptain($student);
    
    /** Return the league in which this team participates.
     * @return the league of this team
     */
    public function getParticipatesInLeague();
    
    /** Set the league in which this team participates.
     * @param league the new league for this team
     * @throws RDException in case the league is null
     */
    public function setParticipatesInLeague($league);
    
    /** Return the league of which this team is the winner.
     * @return the league that this team won
     */
    public function getWinnerOfLeague();
    
    /** Set the league in which this team is the winner.
     * @param league the league that this team won
     * @throws RDException in case the league is null or this team does not participate in the league
     */
    public function setWinnerOfLeague($league);
}
  
?>
