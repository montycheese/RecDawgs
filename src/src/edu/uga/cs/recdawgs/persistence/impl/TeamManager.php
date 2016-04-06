<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 12:25
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;


class TeamManager {
    private $dbConnection = null;
    private $objLayer = null;
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->dbConnection = $objLayer;
    }


    public function save($team){

    }

    public function storeStudentMemberOf($student, $team){

    }

    /**
     * @param Entity\UserImpl $student
     * @param Entity\TeamImpl $team
     * @throws RDException
     */
    public function storeStudentCaptainOf($student, $team){
        $q = 'UPDATE team SET captain_id = ? WHERE team_id = ?;';
        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $student->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $team->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo $student->getUserName() . ' successfully added as team captain of: ' . $team->getName();
        }
        else{
            throw new RDException($student->getUserName() . ' unsuccessfully added as team captain of: ' . $team->getName());
        }
    }

    public function storeParticipatesIn($team, $league){

    }

    public function restore($modelTeam){

    }

    public function restoreStudentMemberOf($team){

    }

    public function restoreStudentCaptainOf($team){

    }

    public function restoreParticipatesIn($team){

    }
    public function restoreTeamWinnerOf($team){

    }

    public function delete($team){

    }

    public function deleteTeamWinnerOf($league, $team){

    }

    public function deleteParticipatesIn($team){

    }
    public function deleteStudentMemberOf($student, $team){

    }

}