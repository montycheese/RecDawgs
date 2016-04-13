<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class StudentIterator extends PersistenceIterator{

    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a Student Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of student data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with Student objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $student = null;
            try {
                $student = $objLayer->createStudent(
                    $resultSet[$i]['first_name'], $resultSet[$i]['last_name'],$resultSet[$i]['user_name'], $resultSet[$i]['password'],
                 $resultSet[$i]['email_address'], $resultSet[$i]['student_id'], $resultSet[$i]['major'], $resultSet[$i]['address']
                );
                $student->setId($resultSet[$i]['user_id']);
                array_push($this->array, $student);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}