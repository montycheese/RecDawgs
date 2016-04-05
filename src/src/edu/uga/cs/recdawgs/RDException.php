<?php
namespace edu\uga\cs\recdawgs;

class RDException extends \Exception {
    private static $serialVersionUID = 1;
    /**
     * Create a new RDException object.
     * @param cause the cause of the exception (cause extends throwable)
     */
    public function __construct($cause=null, $string=null )
        {
            if($cause != null) {
                super($cause);
            }
            else{
                super($message=$string);
            }
        }

}
?>