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
    public function listAll() {
        $html = "";

        try{

            $sportsVenueIter = $this->logicLayer->findSportVenue(null, -1);
            if ($sportsVenueIter->size() == 0) {
                $html .= "<p>No Sports venues</p>";
            }
            else {
                $html .= "<form method='POST' action='sportsVenue.php'>";
                $html .= "<select class='form-control' name='sportsVenueId'>";
                while ($sportsVenueIter->valid()) {
                    $sportsVenue = $sportsVenueIter->current();
                    $sportsVenueId = $sportsVenue->getId();
                    $sportsVenueName = $sportsVenue->getName();
                    $html .= "<option value = '{$sportsVenueId}'>{$sportsVenueName}</option>";
                    $sportsVenueIter->next();
                }
                $html .= "</select>";
                $html .= "<p><input type='submit' value = 'Select Sports Venue'></p>";
                $html .= "</form>";
            }
        }
        catch(RDException $rde){
            echo $rde->string;
        }

        return $html;
    }
    
    
    
    public function listSportsVenueInfo($sportsVenueModel) {
        $html = "";
        try {
            $sportsVenueIter = $this->logicLayer->findSportVenue($sportsVenueModel, -1);
            $sportsVenue = $sportsVenueIter->current();
            $sportsVenueName = $sportsVenue->getName();
            $sportsVenueIsIndoor = $sportsVenue->getIsIndoor() ? "Indoor Venue" : "Outdoor Venue";
            $sportsVenueAddress = $sportsVenue->getAddress();

          $html .= "<h1>Sports Venue: {$sportsVenueName} </h1><br/> <h2>{$sportsVenueIsIndoor}</h2> <br/> <h2>Address: {$sportsVenueAddress}</h2> <br/>";
        }  catch (RDException $rde) {
            echo $rde;
        }
        return $html;


    }

    public function listDeleteButton($sportsVenue=null, $sportsVenueId=-1){
        $html ="<br/><h1>Delete this SportsVenue</h1>";
        if($sportsVenue){
            $sportsVenueId = $sportsVenue->getId();
            $html .= "<form action='php/doDeleteSportsVenue.php' method='post'>
                <input type='hidden' name='sportsVenueId' value='{$sportsVenueId}'>
                <input type='submit' name='Delete sportsVenue'>
                </form>";

            return $html;
        }
        
        if($sportsVenueId > -1){
            $html .= "<formaction='php/doDeleteSportsVenue.php' >
                <input type='hidden' name='sportsVenueId' value='{$sportsVenueId}'>
                <input type='submit' name='Delete SportsVenue'>
                </form>";

            return $html;
        }

        $html = "";
        return $html;

    }

    public function listUpdateButton($sportsVenue=null, $sportsVenueId = -1){
        $html ="<br/><h1>Delete this sportsVenue</h1>";
        if($sportsVenue){
            $sportsVenueId = $sportsVenue->getId();
            $html .= "<form action='php/doUpdateSportsVenue' method='post'><input type='hidden' name='sportsVenueId' value='{$sportsVenueId}'><input type='submit' name='Update sportsVenue'></form>";
        }
        else if($sportsVenueId > -1){
            $html .= "<form><input type='hidden' name='sportsVenueId' value='{$sportsVenueId}'><input type='submit' name='Update sportsVenue' value='Update'></form>";
        }
        return $html;
    }

    public function listCreateButton(){
        $html = "<h2>Create a new sportsVenue</h2><br/><a href='createsportsVenue.php'><button>Create a new Sports Venue</button></a>";
        return $html;
    }
  
}