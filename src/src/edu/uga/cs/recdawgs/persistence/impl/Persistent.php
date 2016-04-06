<?php
namespace edu\uga\cs\recdawgs\persistence\impl;

use edu\uga\cs\recdawgs\persistence\Persistable as Persistable;
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/3/16
 * Time: 15:50
 */

abstract class Persistent implements Persistable{
    private $id = -1;
    private $persistent = false;


    /**
     * Return the persistent identifier of this entity object instance. The value of -1 indicates that
     * the object has not been stored in the persistent data store, yet.
     *
     * @return int identifier of an entity object instance
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the persistent identifier for this entity object.  This method is typically used by the persistence
     * subsystem when creating a proxy object for an entity object already residing in the persistent data store.
     *
     * @param id int persistent object key
     */
    public function setId($id) {
        $this->id = $id;
        $this->persistent = ($id > -1) ? true : false;
    }

    /**
     * Check if this entity object has been stored in the the persistent data store (for the first time).
     * Note that the value is isPersistent() may be true, even though the entity object may need to be saved
     * in the persistent data store again, after an update to its state.
     *
     * @return true if this entity object has already been stored in the persistent data store, false otherwise.
     */
    public function isPersistent() {
        return $this->persistent;
    }
}