<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/6/16
 * Time: 13:37
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;

class MatchManager {
    private $dbConnection = null;
    private $objLayer = null;

    /**
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }

    /**
     * @param Entity\MatchImpl $match
     * @throws RDException
     */
    public function save($match){
        //create Query
        $q = "INSERT INTO" . DB_NAME . ".match (home_points, away_points, date, is_completed,
         home_team_id, away_team_id, sports_venue_id, score_report_id, round_id)
              VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)
              ON DUPLICATE KEY UPDATE
              first_name = VALUES(first_name),
              last_name = VALUES(last_name),
              user_name = VALUES(user_name),
              password = VALUES(password),
              email_address = VALUES(email_address);";
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $administrator->getFirstName(), \PDO::PARAM_STR);
        $stmt->bindParam(2, $administrator->getLastName(), \PDO::PARAM_STR);
        $stmt->bindParam(3, $administrator->getUserName(), \PDO::PARAM_STR);
        $stmt->bindParam(4, $administrator->getPassword(), \PDO::PARAM_STR);
        $stmt->bindParam(5, $administrator->getEmailAddress(), \PDO::PARAM_STR);
        if($stmt->execute()){
            echo 'Administrator created successfully';
        }
        else{
            throw new RDException('Error creating or updating Administrator');
        }
    }

    public function restore(){}


    public function delete(){

    }
}