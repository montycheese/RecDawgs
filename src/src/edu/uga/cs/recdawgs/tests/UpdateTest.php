<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/11/16
 * Time: 17:17
 */

namespace edu\uga\cs\recdawgs\tests;
use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;

class UpdateTest extends \PHPUnit_Framework_TestCase {
    private $persistenceLayer = null;
    private $objLayer = null;

    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    public function testUpdateAdmin(){
        //create
        $john = $this->objLayer->createAdministrator('John', 'Doe', 'jd123', 'password123', 'johndoe@rocketmail.io');
        $sanath = $this->objLayer->createAdministrator('Sanath', 'Bhat', 'sanathbhat6789', 'somepassword', 'sanath@breakingstuff.com');
        $maulesh = $this->objLayer->createAdministrator('Maulesh', 'Triveldi', 'ronaldofangirl123', 'iluvronaldo', 'maulesh99@gmail.com');
        $hillary = $this->objLayer->createAdministrator('Hilary', 'Clinton', 'chillHill', 'whitehouse', 'hillary@whitehouse.edu');
        //store
        $this->objLayer->storeAdministrator($john);
        $this->objLayer->storeAdministrator($sanath);
        $this->objLayer->storeAdministrator($maulesh);
        $this->objLayer->storeAdministrator($hillary);
        echo 'admins created and stored in persistence database successfully.';
    }

    public function testUpdateStudent(){
        $montana = $this->objLayer->createStudent($firstName="Montana", $lastName="Wong", $userName='mwong9');
        $montana = $this->objLayer->findStudent($montana)->current();
        $montana->setUserName('montycheese');
        $montana->setEmailAddress('montanawong@gmail.com');

        //store
        $this->objLayer->storeStudent($montana);
        echo 'student queried, updated, and stored in persistence database successfully';
    }

    public function testUpdateLeague(){
        //query
        $soccer = $this->objLayer->createLeague($name = 'Indoor Soccer', $isIndoor=true, $minTeams=4);
        $soccer = $this->objLayer->findLeague($soccer);

        //update
        $soccer->setMinTeams(5);
        $soccer->setMaxTeams(25);
        $soccer->setMinMembers(6);
        $soccer->setMaxMembers(10);

        //store
        $this->objLayer->storeLeague($soccer);
        echo 'leagues queried, updated, and stored in persistent database successfully';
    }

    public function testUpdateTeam(){
        $trustii = $this->objLayer->createTeam($name='Trustii');
        $trustii = $this->objLayer->findLeague($trustii);

        //update
        $trustii->setName('Trustii-UPDATED');

        //store
        $this->objLayer->storeTeam($trustii);
        echo 'teams queried, updated, and stored in persistent database successfully';
    }

    public function testUpdateMatch(){
        $match = $this->objLayer->createMatch($homePoints = 30, $awayPoints = 29, $date = "2016-4-11", 
        $isCompleted = true);
        
        //update
        $match->setHomePoints(1000);
        $match->setAwayPoints(10000);
        $match->setIsCompleted(false);
        
        //store
        $this->objLayer->storeMatch($match);
        echo 'Match queried, updated, and stored in persistent database successfully';
    }
    public function testUpdateScoreReport(){
        $scoreReport = $this->objLayer->createScoreReport($homePoints = 30, $awayPoints = 21, $date = "2016-4-10");
        
        //update
        $scoreReport->setHomePoints(1000);
        $scoreReport->setAwayPoints(1000);
        $scoreReport->setDate = "2016-28-10";
        
        //store
        $this->objLayer->storeScoreReport($scoreReport);
                                                    
                                                
    }
    public function testUpdateSportsVenue(){
       // $sportsVenue = $this->objLayer->createSportsVenue($name = null, $address = null, $isIndoor = null);
    }

    public function testUpdateRound(){

    }
}
