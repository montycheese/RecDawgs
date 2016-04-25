<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/23/16
 * Time: 13:47
 */

namespace edu\uga\cs\recdawgs\presentation;
require_once("autoload.php");
use edu\uga\cs\recdawgs\logic\impl\LogicLayerImpl as LogicLayerImpl;
use edu\uga\cs\recdawgs\RDException;

class TeamUI {
    private $logicLayer = null;

    /**
     * @param LogicLayerImpl $logicLayer
     */
    public function __construct(){
        $this->logicLayer = new LogicLayerImpl();
    }

    public function listAll(){
        $html="";
        try{
            $teamIter = $this->logicLayer->findTeam(null);
            if($teamIter) {
                while ($teamIter->valid()) {
                    $team = $teamIter->current();
                    $teamId = $team->getId();
                    $teamName = $team->getName();
                    $html .= "<option value='{$teamId}'>{$teamName}</option>";
                    $teamIter->next();
                }
            }
        }
        catch(RDException $rde){
            //todo
        }
        return $html;
    }

    /**
     * Generate html dropdown of all teams a student is in
     *
     * @param null $student
     * @param int $studentId
     * @return string
     */
    public function listAllContainingStudent($student=null, $studentId=-1){
        $html = "";
        try {
            if ($student != null) {
                $teamIter = $this->logicLayer->findTeamsIsMemberOf($student);
                if($teamIter) {
                    while ($teamIter->valid()) {
                        $team = $teamIter->current();
                        $teamId = $team->getId();
                        $teamName = $team->getName();
                        $html .= "<option value='{$teamId}'>{$teamName}</option>";
                        $teamIter->next();
                    }
                }
            }
            else if ($studentId > -1) {
                $teamIter = $this->logicLayer->findTeamsIsMemberOf(null, $studentId);
                if($teamIter) {
                    while ($teamIter->valid()) {
                        $team = $teamIter->current();
                        $teamId = $team->getId();
                        $teamName = $team->getName();
                        $html .= "<option value='{$teamId}'>{$teamName}</option>";
                        $teamIter->next();
                    }
                }
            }
        }
        catch(RDException $rde){
            //todo
            echo $rde->string;
        }

        return $html;

    }

    /**
     * Show info for team given the team object or the team id
     *
     * @param null $team
     * @param int $teamId
     * @return mixed
     */
    public function listOne($team=null, $teamId=-1){
        $html = "";
        if($team != null){

        }
        else if($teamId > -1){

        }
        else{
            return null;
        }
    }
}