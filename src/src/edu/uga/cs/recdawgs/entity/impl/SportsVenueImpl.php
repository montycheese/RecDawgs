<?php
namespace edu\uga\cs\recdawgs\entity\impl;

use edu\uga\cs\recdawgs\entity\SportsVenue as SportsVenue;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;
//use edu\uga\cs\recdawgs\RDException as RDException;

class SportsVenueImpl extends Persistent implements SportsVenue {

    /** This class represents a sports venue for playing matches.
     * A sports venue has a name, address, and is classified as an indoor venue or not.
     * The name must be unique across all sports venues.
     *
     */
    private $name;
    private $isIndoor;
    private $address;

    /**
     * SportsVenueImpl constructor.
     * @param $name
     * @param $isIndoor
     * @param $address
     */
    public function __construct($name=null, $isIndoor=null, $address=null) {
        $this->name = $name;
        $this->isIndoor = $isIndoor;
        $this->address = $address;
    }

    /** Return the name of this sports venue.
     * @return $this->name
     */
    public function getName() {
        return $this->name;
    }

    /** Set the new address for this sports venue.
     * @param $name
     */
    public function setName($name){
        $this->name = $name;
    }

    /** Return the indoor status of this sports venue.
     * @return $this->isIndoor
     */
    public function getIsIndoor(){
        return $this->isIndoor;
    }

    /** Set the new indoor status for this sports venue.
     * @param $isIndoor
     */
    public function setIsIndoor($isIndoor){
        $this->isIndoor = $isIndoor;
    }

    /** Return the address of this sports venue.
     * @return $this->address
     */
    public function getAddress(){
        return $this->address;
    }

    /** Set the new address for this sports venue
     * @param $address
     */
    public function setAddress($address){
        $this->address = $address;
    }
}