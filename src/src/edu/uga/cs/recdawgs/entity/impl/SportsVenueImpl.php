<?php

require('../SportsVenue.php');

class SportsVenueImpl implements SportsVenue {

    /** This class represents a sports venue for playing matches.
     * A sports venue has a name, address, and is classified as an indoor venue or not.
     * The name must be unique across all sports venues.
     *
     */
    var $name;
    var $isIndoor;
    var $address;

    /**
     * SportsVenueImpl constructor.
     * @param $name
     * @param $isIndoor
     * @param $address
     */
    public function __construct($name, $isIndoor, $address) {
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