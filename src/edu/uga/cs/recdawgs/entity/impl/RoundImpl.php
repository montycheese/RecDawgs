<?php
namespace edu\uga\cs\recdawgs\entity\impl;
use edu\uga\cs\recdawgs\entity\Round as Round;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents a round of matches played in some sports league.  Each round of
 * matches is numbered (the round number must be positive).
 *
 */

class RoundImpl extends Persistent implements Round {
    private $number;
    private $league;
    
    public function __constructor($number=null, $league=null) {
        $this->number = $number;
        $this->league = $league;
    }
    
    /** Return this round's number.
     * @return the number of this round of matches.
     */
    public function getNumber() {
        return $this->number;   
    }

    /** Set the new number for this round of matches.
     * @param number the new number of this round of matches
     * @throws RDException in case number is not positive
    */
    public function setNumber( $number ){ // throws RDException;
        if($number < 0)  {
            throw new RDException('Round number cannot be negative.');   
        } else {
            $this->number = $number;
        }
    }   
    /**
     * Set the league in which this round of matches is played
     *
     * @param League $league
     * @return void
     */
    public function setLeague($league) {
        $this->league = $league;
    }
    public function getLeague(){
        return $this->league;
    }

}
?>