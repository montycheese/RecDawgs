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
    public function listMatchInfo($match=null, $matchId=-1, $homeScore = -1, $awayScore=-1){
        $html = "";
        try {
            if ($match) {
                $leagueName = $match->getHomeTeam()->getParticipatesInLeague()->getName();
                $roundNumber = strval($match->getRound()->getNumber());
                $date = $match->getDate() ? $match->getDate() : "Date not set yet";

                $homeTeamName = $match->getHomeTeam()->getName();
                $awayTeamName = $match->getAwayTeam()->getName();
                $venueName = $match->getSportsVenue()->getName();
                $homeTeamScore=  ($homeScore > -1 && strval($match->getHomePoints()) == "") ? $homeScore : strval($match->getHomePoints());
                $awayTeamScore = ($awayScore > -1 && strval($match->getHomePoints())=="") ? $awayScore : strval($match->getAwayPoints());
                $html .= "<h1>League: {$leagueName} Round: {$roundNumber} Date: {$date}</h1><br/>";
                $html .= "<h2>Home team: {$homeTeamName} Away team: {$awayTeamName} Venue: {$venueName}</h2><br/>";
                //TODO ADD IF statement to show score only if game is done
                $html .= "<h3>Home team score: {$homeTeamScore} Away team Score: {$awayTeamScore}</h3>";

            } else if ($matchId > -1) {
                $match = $this->logicLayer->findMatch(null, $matchId)->current();
                //die(var_dump($match));
                $leagueName = $match->getHomeTeam()->getParticipatesInLeague()->getName();
                $roundNumber = strval($match->getRound()->getNumber());
                $date = $match->getDate();
                $homeTeamName = $match->getHomeTeam()->getName();
                $awayTeamName = $match->getAwayTeam()->getName();
                $venueName = $match->getSportsVenue()->getName();
                $homeTeamScore=  ($homeScore > -1 && strval($match->getHomePoints())=="") ? $homeScore : strval($match->getHomePoints());
                $awayTeamScore = ($awayScore > -1 && strval($match->getHomePoints())=="") ? $awayScore : strval($match->getAwayPoints());
                $html .= "<h1>League: {$leagueName}<br/> Round: {$roundNumber}<br/> Date: {$date}</h1><br/>";
                $html .= "<h2>Home team: {$homeTeamName} <br/> Away team: {$awayTeamName} <br/> Venue: {$venueName}</h2><br/>";
                //TODO ADD IF statement to show score only if game is done
                $html .= "<h3>Home team score: {$homeTeamScore} <br/>Away team Score: {$awayTeamScore}</h3><br/>";
            }
        }
        catch(\Exception $e){
            echo $e->getTraceAsString();
        }
        return $html;
    }

    public function listUpcomingMatches($team) {

        $html = "";
        $matches = $this->logicLayer->findTeamsMatchesInLeague($team, null);
        if(count($matches) <= 0) {
            return "<h3>There are no matches scheduled.</h3>";
        }
        try {
            //ie(var_dump($matches));
            $html .= "<h3>Upcoming matches: </h3> <br/> <br/>";
            $html .= "<form method='POST' action='match.php'>";
            $html .= "<select class='form-control' name='matchId'>";
            for($i=0; $i<count($matches); $i++){
            //while ($matchIter->valid()) {

                $match = $matches[$i];
                $homeTeam = $match->getHomeTeam()->getName();
                $awayTeam = $match->getAwayTeam()->getName();
                $roundNum = $match->getRound()->getNumber();
                $matchId = $match->getId();

                $html .= "<option value = '{$matchId}'>Round {$roundNum}: {$homeTeam} vs. {$awayTeam}</option>";
            }
            $html .= "</select>";
            $html .= "<p><input type='submit' value = 'View Match'></p>";
            $html .= "</form>";
        } catch (RDException $rde) {
            echo $rde->getTraceAsString();
        }
        return $html;
    }

    public function listResolveMatchScoreButton($matchId) {
        $html = "<form action='php/doResolveMatchScore' method='post'>Home Team Score: <input type='text' name='homeTeamScore'><br>Away Team Score: <input type='text' name='awayTeamScore'> <input type = 'hidden' name = 'matchId' value = '{$matchId}'><input type=\"submit\" name=\"Enter Fixed Match Score\" id=\"enterMatchScore\"></form>";
        return $html;
    }
}