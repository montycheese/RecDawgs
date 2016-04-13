<?php

namespace edu\uga\cs\recdawgs\entity\impl;

use edu\uga\cs\recdawgs\entity\Team as Team;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
use edu\uga\cs\recdawgs\RDException as RDException;

class TeamImpl extends Persistent implements Team {

    private $name = null;
    private $captain = null;
    private $participatesInLeague = null;
    private $winnerOfLeague = null;

    /**
     * TeamImpl constructor.
     * @param $name
     * @param $captain
     * @param $participatesInLeague
     * @param $winnerOfLeague
     */
    public function __construct($name=null, $captain=null, $participatesInLeague=null, $winnerOfLeague=null)
    {
        $this->name = $name;
        $this->captain = $captain;
        $this->participatesInLeague = $participatesInLeague;
        $this->winnerOfLeague = $winnerOfLeague;
    }

    /** Return the name of this team.
     * @return a string which is the name of this team
     */
    public function getName(){
        return $this->name;
    }

    /** Set the new name for this team.
     * @param name the new name for this team
     */
    public function setName($name) {
        $this->name = $name;

    }

    /** Return the team's captain.
     * @return the student who is this team's captain
     */
    public function getCaptain(){
        return $this->captain;
    }

    /** Set the team's captain.
     * @param student the student who is the new captain of this team
     * @throws RDException in case the student is null
     */
    public function setCaptain($student){
        if ($student == null) {
            throw new RDException('This student object is null.');
        }
        else {
            $this->captain = $student;
        }
    }

    /** Return the league in which this team participates.
     * @return the league of this team
     */
    public function getParticipatesInLeague(){
        return $this->participatesInLeague;
    }

    /** Set the league in which this team participates.
     * @param league the new league for this team
     * @throws RDException in case the league is null
     */
    public function setParticipatesInLeague($league){
        if ($league == null){
            throw new RDException('The league object is null.');
        }
        else {
            $this->participatesInLeague = $league;
        }
    }

    /** Return the league of which this team is the winner.
     * @return the league that this team won
     */
    public function getWinnerOfLeague(){
        return $this->winnerOfLeague;
    }

    /** Set the league in which this team is the winner.
     * @param league the league that this team won
     * @throws RDException in case the league is null or this team does not participate in the league
     */
    public function setWinnerOfLeague($league){
        if ($league == null)  {
            throw new RDException('The league object is null.');
        }
        else if ($this->participatesInLeague == false) {
            throw new RDException('This team does not participate in this league.');
        }
        else {
            $this->winnerOfLeague = $league;
        }
    }
}