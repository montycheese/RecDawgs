<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/7/16
 * Time: 16:40
 */

namespace edu\uga\cs\recdawgs\persistence\impl;
use edu\uga\cs\recdawgs\RDException as RDException;
use edu\uga\cs\recdawgs\entity\impl as Entity;
use edu\uga\cs\recdawgs\object\impl as Object;


class LeagueManager {
    private $dbConnection = null;
    private $objLayer = null;

    /**
     * Constructor
     *
     * @param \PDO $dbConnection A connection to the database in form of PDO
     * @param Object\ObjectLayerImpl $objLayer
     */
    public function __construct($dbConnection, $objLayer){
        $this->dbConnection = $dbConnection;
        $this->objLayer = $objLayer;
    }

    public function save($league){

    }

    public function storeWinner($team, $league){
        //create entry in is_winner_of table
        $q = 'INSERT INTO is_winner_of (team_id, league_id) VALUES(?, ?);';
        //create prepared statement from query
        $stmt = $this->dbConnection->prepare($q);
        //bind parameters to prepared statement
        $stmt->bindParam(1, $team->getId(), \PDO::PARAM_INT);
        $stmt->bindParam(2, $league->getId(), \PDO::PARAM_INT);
        if($stmt->execute()){
            echo 'Link created successfully';
        }
        else{
            throw new RDException('Error creating ');
        }
    }

    /**
     * Return winner of this league
     *
     * @param Entity\LeagueImpl $league
     * @return Entity\TeamImpl
     * @throws RDException
     */
    public function restoreWinner($league){
        $q = 'SELECT team.team_id, team.name, team.captain_id
            from team
            INNER JOIN league_team
            ON team.team_id = league_team.team_id
            WHERE league_team.league_id =  ?
            LIMIT 1;';

        $stmt = $this->dbConnection->prepare($q);
        $stmt->bindParam(1, $league->getId(), \PDO::PARAM_INT);
        if ($stmt->execute()){
            //get results from Query
            $resultSet = $stmt->fetchAll(\PDO::FETCH_ASSOC);
            // return iterator
            return (new TeamIterator($resultSet, $this->objLayer))->current();
        }
        else{
            throw new RDException('Error restoring winner');
        }
    }

    public function restore($leagueModel){

    }

    public function delete($league){

    }


}