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
        parent::__construct();
        $this->resultSet = $resultSet;
        $this->objLayer = $objLayer;

        //echo "REsult SET: " . var_dump($resultSet);
        //echo "REsult SET: " . var_dump($resultSet['first_name']);
        /**
         * Populate the iterator with admub objects
         */
        for($i=0; $i < count($resultSet); $i++){
            try {
                $admin = $objLayer->createAdministrator(
                    $firstName=$resultSet[$i]['first_name'],
                    $lastName=$resultSet[$i]['last_name'],
                    $userName=$resultSet[$i]['user_name'],
                    $password=$resultSet[$i]['password'],
                    $emailAddress=$resultSet[$i]['email_address']
                );
                $admin->setId($resultSet[$i]['user_id']);
                //var_dump($admin->getUserName());
                array_push($this->array, $admin);

            }
            catch(RDException $rde){
                echo $rde;
            }

        }

        echo '


                AFTER: ' . var_dump($this->array);
    }
}