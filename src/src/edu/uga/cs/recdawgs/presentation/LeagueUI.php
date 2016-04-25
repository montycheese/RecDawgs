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
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl\LogicLayerImpl();
    }

    public function listAll() {
    	$html = "";

        try{

        	$leagues = $this->logicLayer->findLeague(null, -1);
		    $league = $leagues->current();

		    if ($leagues->size() == 0) {
		        $html .= "<p>No leagues</p>";
		    } else {
		        $html .= "<form method='POST' action='league.php'>";
		        $html .= "<select class='form-control' name='leagues' id='leagues'>";

		        while ($league != null) {
		            $leagueName = $league->getName();
                    $leagueID = $league->getID();
		            $html .= "<option value = '{$leagueID}'>{$leagueName}</option>";
		            $leagues->next();
                    $league = $leagues->current();
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