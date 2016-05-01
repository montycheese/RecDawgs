<?php
namespace edu\uga\cs\recdawgs;

class RDException extends \Exception {
    private static $serialVersionUID = 1;
    public $string;
    /**
     * Create a new RDException object.
     * @param String $string A string containing the message pertaining to the exception
     * @param RDException $prev the previous exception thrown from the stack frame
     */
    public function __construct($string=null,$prev=null)
        {
            $this->string = $string;
            if($prev != null) {
                parent::__construct($previous=$prev);
            }
            else{
                parent::__construct($message=$string);
            }
        }

}
?>
