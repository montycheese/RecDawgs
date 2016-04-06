<?php
namespace edu\uga\cs\recdawgs;

class RDException extends \Exception {
    private static $serialVersionUID = 1;
    /**
     * Create a new RDException object.
     * @param prev Exception the cause of the exception (cause extends Exception)
     * @param string String A string containing the message pertaining to the exception
     */
    public function __construct($prev=null, $string=null )
        {
            if($prev != null) {
                parent::__construct($previous=$prev);
            }
            else{
                parent::__construct($message=$string);
            }
        }

}
?>