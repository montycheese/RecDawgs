<?php
namespace edu\uga\cs\recdawgs\entity\impl;
use edu\uga\cs\recdawgs\entity\Administrator as Administrator;
use edu\uga\cs\recdawgs\persistence\impl\Persistent as Persistent;


/** This class represents an Administrator user in the RecDawgs system.  It has no additional attributes beyond those inherited from User.
*
*/

class AdministratorImpl extends Persistent extends UserImpl implements Administrator { //NOT SURE WHAT TO DO HERE

  public function __construct()(
      parent::__construct();
   
  }
       

}

?>