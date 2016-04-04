<?php
namespace edu\uga\cs\recdawgs\entity;

use edu\uga\cs\recdawgs\persistence\Persistable as Persistable;
use edu\uga\cs\recdawgs\RDException as RDException;

/** This class represents a round of matches played in some sports league.  Each round of
 * matches is numbered (the round number must be positive).
 *
 */
interface Round
    extends Persistable
{
    /** Return this round's number.
     * @return the number of this round of matches.
     */
    public function getNumber();

    /** Set the new number for this round of matches.
     * @param number the new number of this round of matches
     * @throws RDException in case number is not positive
    */
    public function setNumber( $number ); // throws RDException;
}
?>