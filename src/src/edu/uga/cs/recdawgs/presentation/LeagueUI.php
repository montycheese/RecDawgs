<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:48
 */


namespace edu\uga\cs\recdawgs\presentation;

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class LeagueUI {
    private $logicLayer = null;

    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct($logicLayer=null){
        $this->logicLayer = (isset($logicLayer)) ? $logicLayer : new LogicLayerImpl();
    }

    public function listIndoor() {
    	$html = "";

        try{

        	$leaguesIndoor = $this->logicLayer->findLeague(null, -1);
		    $leagueIndoor = $leaguesIndoor->current();

		    if ($leaguesIndoor->size() == 0) {
		        $html .= "<p>No leagues</p>";
		    } else {
		        $html .= "<form method='POST' action='league.php'>";
		        $html .= "<select class='form-control'>";

		        while ($leagueIndoor != null) {
		            $leagueName = $leagueIndoor->getName();
		            $html .= "<option value = '{$leagueName}'>{$leagueName}</option>";
		            $leaguesIndoor->next();
                    $leagueIndoor = $leaguesIndoor->current();
		        }

		        $html .= "</select>";
		        $html .= "<p><input type='submit' value = 'Select League'></p>";
		        $html .= "</form>";
		    }
        }
        catch(RDException $rde){
            //todo
            echo $rde->string;
        }

        return $html;
    }

    public function listOutdoor() {
    	$html = "";

        try{
        	$leagueModel = $_SESSION['logicLayer']->createLeague(
			    null, null, null, False, null, null, null, null);
        	$leaguesIndoor = $this->logicLayer->findLeague($leagueModel);
		    $leagueIndoor = $leaguesIndoor->current();

		    if ($leaguesIndoor->size() == 0) {
		        $html .= "<p>No outdoor leagues</p>";
		    } else {
		        $html .= "<form method='POST' action='league.php'>";
		        $html .= "<select class='form-control'>";

		        while ($leagueIndoor != null) {
		            $leagueName = $leagueIndoor->getName();
		            $html .= "<option value = '{$leagueName}'>{$leagueName}</option>";
		            $leaguesIndoor->next();
                    $leagueIndoor = $leaguesIndoor->current();
		        }

		        $html .= "</select>";
		        $html .= "<p><input type='submit' value = 'Select League'></p>";
		        $html .= "</form>";
		    }
        }
        catch(RDException $rde){
            //todo
            echo $rde->string;
        }

        return $html;
    }
}