<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/30/16
 * Time: 18:11
 */


namespace edu\uga\cs\recdawgs\presentation;

require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\object\impl\ObjectLayerImpl as ObjectLayerImpl;
use edu\uga\cs\recdawgs\RDException;


class ScoreReportUI {
    private $logicLayer = null;


    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    public function showMatchReports($matchId){
        $html = "";
        $o = $this->logicLayer->objectLayer;
        $scoreReport = $o->createScoreReport();
        $match = $o->createMatch();
        $match->setId($matchId);
        $match = $o->findMatch($match)->current();
        $scoreReport->setMatch($match);
        $scoreReportIter = $o->findScoreReport($scoreReport);
        //die(var_dump($scoreReportIter));
        if($scoreReportIter->size() > 0){
            $i=1;
            while($scoreReportIter->valid()){
                $report = $scoreReportIter->current();
                $homeScore = $report->getHomePoints();
                $awayScore = $report->getAwayPoints();
                $date = $report->getDate();
                $student = $report->getStudent()->getFirstName() . ' ' . $report->getStudent()->getLastName();
                $html .= "<h2>Score report {$i}</h2><br/>";
                $html .= "<li>Submitted by: {$student}</li>";
                $html .= "<li>Home score: {$homeScore}</li>";
                $html .= "<li>Away score: {$awayScore}</li>";
                $html .= "<li>Date:  {$date}</li>";

                $scoreReportIter->next();
                ++$i;
            }
            $html .= "</ul>";
        }
        return $html;
    }

    public function getNumScoreReports($matchId){
        $o = $this->logicLayer->objectLayer;
        $scoreReport = $o->createScoreReport();
        $match = $o->createMatch();
        $match->setId($matchId);
        $match = $o->findMatch($match)->current();
        $scoreReport->setMatch($match);
        $scoreReportIter = $o->findScoreReport($scoreReport);
        return $scoreReportIter->size();
    }

    public function getScores($matchId){
        try{
            $o = $this->logicLayer->objectLayer;
            $scoreReport = $o->createScoreReport();
            $match = $o->createMatch();
            $match->setId($matchId);
            $match = $o->findMatch($match)->current();
            $scoreReport->setMatch($match);
            $scoreReportIter = $o->findScoreReport($scoreReport);
            $a = array();
            $report1 = $scoreReportIter->current();
            $score1 = ['homeScore'=> $report1->getHomePoints(), 'awayScore'=>$report1->getAwayPoints()];
            array_push($a, $score1);
            $scoreReportIter->next();
            $report2 = $scoreReportIter->current();
            $score2 =  ['homeScore'=> $report2->getHomePoints(), 'awayScore'=>$report2->getAwayPoints()];

            if($score1['homeScore'] == $score2['homeScore'] && $score1['awayScore'] == $score2['awayScore']){
                array_push($a, $score2);
                return $a;
            }
        }
        catch (RDException $rde){
            return null;
        }
        return null;
    }
}