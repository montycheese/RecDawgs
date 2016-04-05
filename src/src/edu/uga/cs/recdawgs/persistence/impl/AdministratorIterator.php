<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 11:03
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class AdministratorIterator extends PersistenceIterator{

    private $resultSet = null;
    private $objLayer = null;

    /**
     * Creates a admin Iterator
     *
     * @param $resultSet array Associative array containing an array of rows of admin data returned from a DB query
     * @param $objLayer ObjectLayerImpl instance of the object layer object
     */
    public function __construct($resultSet, $objLayer){
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        /**
         * Populate the iterator with Student objects
         */
        for($i=0; $i < count($resultSet); $i++){
            $admin = null;
            try {
                $admin = $objLayer->createAdministrator(
                    $resultSet['first_name'],
                    $resultSet['last_name'],
                    $resultSet['user_name'],
                    $resultSet['password'],
                    $resultSet['email_address']
                );
                $admin.setId($resultSet['user_id']);
                array_push($this->array, $admin);
            }
            catch(RDException $rde){
                echo $rde;
            }

        }
    }
}