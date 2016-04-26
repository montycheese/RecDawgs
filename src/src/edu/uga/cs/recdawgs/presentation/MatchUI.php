<?php
/**
 * Created by PhpStorm.
 * User: mwong
 * Date: 4/26/16
 * Time: 1:24 PM
 */

namespace edu\uga\cs\recdawgs\presentation;

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class MatchUI {
    private $logicLayer = null;

    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    /**
     * @param \edu\uga\cs\recdawgs\entity\impl\MatchImpl $match
     * @param int $matchId
     * @return string
     */
    public function listMatchInfo($match=null, $matchId=-1){
        $html = "";
        try {
            if ($match) {
                $leagueName = $match->getHomeTeam()->getLeague()->getName();
                $roundNumber = strval($match->getRound()->getNumber());
                $date = $match->getDate();
                $homeTeamName = $match->getHomeTeam()->getName();
                $awayTeamName = $match->getAwayTeam()->getName();
                $venueName = $match->getSportsVenue()->getName();
                $homeTeamScore=  strval($match->getHomePoints());
                $awayTeamScore = strval($match->getAwayPoints());
                $html .= "<h1>League: {$leagueName} Round: {$roundNumber} Date: {$date}</h1><br/>";
                $html .= "<h2>Home team: {$homeTeamName} Away team: {$awayTeamName} Venue: {$venueName}</h2><br/>";
                //TODO ADD IF statement to show score only if game is done
                $html .= "<h3>Home team score: {$homeTeamScore} Away team Score: {$awayTeamScore}</h3>";

            } else if ($matchId > -1) {
                $match = $this->logicLayer->findMatch(null, $matchId)->current();
                $leagueName = $match->getHomeTeam()->getLeague()->getName();
                $roundNumber = strval($match->getRound()->getNumber());
                $date = $match->getDate();
                $homeTeamName = $match->getHomeTeam()->getName();
                $awayTeamName = $match->getAwayTeam()->getName();
                $venueName = $match->getSportsVenue()->getName();
                $homeTeamScore=  strval($match->getHomePoints());
                $awayTeamScore = strval($match->getAwayPoints());
                $html .= "<h1>League: {$leagueName} Round: {$roundNumber} Date: {$date}</h1><br/>";
                $html .= "<h2>Home team: {$homeTeamName} Away team: {$awayTeamName} Venue: {$venueName}</h2><br/>";
                //TODO ADD IF statement to show score only if game is done
                $html .= "<h3>Home team score: {$homeTeamScore} Away team Score: {$awayTeamScore}</h3>";
            }
        }
        catch(\Exception $e){
            echo $e->getTraceAsString();
        }
        return $html;
    }
}