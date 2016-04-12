<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/11/16
 * Time: 17:17
 */

namespace edu\uga\cs\recdawgs\tests;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;
use edu\uga\cs\recdawgs\RDException;

class DeleteTest extends \PHPUnit_Framework_TestCase {
    private $persistenceLayer = null;
    private $objLayer = null;

    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    /**
     * Reads all admin objs from persistence db
     */
    public function testDeleteAdmin(){
        echo 'Querying an Admin object:\n ';
        $iter = $this->objLayer->findAdministrator($this->objLayer->createAdministrator($userName='jd123'));
        while($iter->hasNext()){
            $admin = $iter->current();
            echo 'userid: ' . strval($admin->getId()) .' '. $admin->getFirstName() . ' '  . $admin->getLastName();
            echo 'deleting this admin';
            try {
                $this->objLayer->deleteAdministrator($admin);
                echo 'Deletion successful';
            }
            catch(RDException $r){
                echo 'Error deleting admin obj';
            }
            $iter->next();
        }
    }

    public function testDeleteStudent(){
        echo 'Student objects:\n ';
        $iter = $this->objLayer->findStudent(null);
        $i=0;
        while($iter->hasNext()){
            $student = $iter->current();
            echo 'student id: ' . strval($student->getId()) .' '. $student->getFirstName() . ' '  . $student->getLastName();
            $iter->next();
            ++$i;
        }
        echo strval($i) . ' total objects';
    }
}
