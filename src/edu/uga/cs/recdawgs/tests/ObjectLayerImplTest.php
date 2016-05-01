<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/11/16
 * Time: 09:04
 */

namespace edu\uga\cs\recdawgs\tests;

use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;

class ObjectLayerImplTest extends \PHPUnit_Framework_TestCase{
    private $persistenceLayer = null;
    private $objLayer = null;

    /**
     * ObjectLayerImplTest constructor.
     */
    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    /**
     * Tests reading from db.
     */
    public function testRead(){

    }
}