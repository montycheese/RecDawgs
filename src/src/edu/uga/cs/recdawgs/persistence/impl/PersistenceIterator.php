<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/5/16
 * Time: 10:09
 */
namespace edu\uga\cs\recdawgs\persistence\impl;


class PersistenceIterator implements \Iterator {
    private $position = 0;
    public $array = array();


    /**
     * PersistenceIterator constructor.
     */
    function __construct()
    {
        $this->position = 0;
    }

    /**
     *
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current()
    {
        return $this->array[$this->position];
    }

    /**
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid()
    {
        return isset($this->array[$this->position]);
    }

    /**
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Checks if there is another item in the iterator
     *
     * @return bool true if another item exists, false otherwise
     */
    public function hasNext()
    {
        return $this->position < count($this->array) - 1;
    }

    public function size(){
        return count($this->array);
    }



}