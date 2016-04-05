<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\entity\impl\UserImpl as UserImpl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class StudentIterator extends PersistenceIterator{

    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a Student Iterator
     *
     * @param $resultSet array Associative array containing rows of data returned for a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with Student objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $student = null;
            try {
                $student = $objLayer->createStudent(
                    $resultSet['first_name'], $resultSet['last_name'],$resultSet['user_name'], $resultSet['password'],
                 $resultSet['email_address'], $resultSet['studentId'], $resultSet['major'], $resultSet['address']
                );

                array_push($this->array, $student);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}