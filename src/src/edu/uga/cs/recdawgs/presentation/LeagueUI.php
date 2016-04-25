<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:48
 */
namespace edu\uga\cs\recdawgs\presentation;

require_once("autoload.php");

use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class LeagueUI {
    private $logicLayer = null;

    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    public function getLeague($leagueId){
        return $this->logicLayer->findLeague(null, $leagueId)->current();
    }

    public function listAll() {
    	$html = "";

        try{

        	/*$leagues = $this->logicLayer->findLeague(null, -1);
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
		    }*/

            $leagueIter = $this->logicLayer->findLeague(null, -1);
            if ($leagueIter->size() == 0) {
                $html .= "<p>No leagues</p>";
            }
            else {
                $html .= "<form method='POST' action='league.php'>";
                $html .= "<select class='form-control' name='leagueId'>";
                while ($leagueIter->valid()) {
                    $league = $leagueIter->current();
                    $leagueId = $league->getId();
                    $leagueName = $league->getName();
                    $html .= "<option value = '{$leagueId}'>{$leagueName}</option>";
                    $leagueIter->next();
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


    /**
     *
     * generate html toList all teams in the league.
     * @param null $league
     * @param int $leagueId
     * @return string
     */
    public function listAllTeams($league=null, $leagueId=-1){
        $html = "";
        try {
            if ($league != null) {
                $teamIter = $this->logicLayer->findTeamsInLeague($league);
                if ($teamIter != null) {
                    while ($teamIter->valid()) {
                        $team = $teamIter->current();
                        $teamName = $team->getName();
                        $teamId = $team->getId();
                        $html .= "<option value='{$teamId}'>{$teamName}</option>";
                        $teamIter->next();
                    }
                }
            }
            else if ($leagueId > -1) {
                $league = $this->logicLayer->findLeague(null, $leagueId);
                $teamIter = $this->logicLayer->findTeamsInLeague($league);
                if ($teamIter != null) {
                    while ($teamIter->valid()) {
                        $team = $teamIter->current();
                        $teamName = $team->getName();
                        $teamId = $team->getId();
                        $html .= "<option value='{$teamId}'>{$teamName}</option>";
                        $teamIter->next();
                    }
                }
            }
        }
        catch (RDException $rde){
            echo $rde->getTraceAsString();
        }
        return $html;
    }
}