<?php
namespace edu\uga\cs\recdawgs\presentation;

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class SportsVenueUI {
    private $logicLayer = null;

    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    public function listSportsVenueInfo($sportsVenueModel) {
        $html = "";
        try {
            $sportsVenueIter = $this->logicLayer->findSportsVenue($sportsVenueModel, -1);
            $sportsVenue = $sportsVenueIter->current();
            $sportsVenueName = $sportsVenue->getName();
            $sportsVenueIsIndoor = $sportsVenue->getIndoor();
            $sportsVenueAddress = $sportsVenue->getAddress();

          $html .= "<h1>Sports Venue: {$sportsVenueName} </h1><br/> <h2>Is indoor: {$sportsVenueIsIndoor}</h2> <br/> <h2>Address: {$sportsVenueAddress}</h2> <br/>";
        }  catch (RDException $rde) {
            echo $rde;
        }
        return $html;


    }
  
}