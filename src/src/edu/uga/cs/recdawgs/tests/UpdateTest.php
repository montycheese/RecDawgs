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

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});

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
        $john = $this->objLayer->createAdministrator('jd123');
        $john = $this->objLayer->findAdministrator($john)->current();

        $john->setUserName('JOHNDOE123');

        //store
        $this->objLayer->storeAdministrator($john);

        echo '

        admins created and stored in persistence database successfully.

        ';
    }

    public function testUpdateStudent(){
        $montana = $this->objLayer->createStudent();
        $montana->setFirstName("Montana");
        $montana->setLastName("Wong");
        $montana->setUserName("mwong9");

        // update
        $montana = $this->objLayer->findStudent($montana)->current();
        $montana->setUserName('montycheese');
        $montana->setEmailAddress('montanawong@gmail.com');

        //store
        $this->objLayer->storeStudent($montana);
        echo '

        student queried, updated, and stored in persistence database successfully

        ';
    }

    public function testUpdateLeague(){
        //query
        $soccer = $this->objLayer->createLeague();
        $soccer->setName('Indoor Soccer');
        $soccer->setIsIndoor(true);
        $soccer->minTeam(4);
        $soccer = $this->objLayer->findLeague($soccer)->current();

        //update
        $soccer->setMinTeams(5);
        $soccer->setMaxTeams(25);
        $soccer->setMinMembers(6);
        $soccer->setMaxMembers(10);

        //store
        $this->objLayer->storeLeague($soccer);
        echo '

        leagues queried, updated, and stored in persistent database successfully

        ';
    }

    public function testUpdateTeam(){
        $trustii = $this->objLayer->createTeam();
        $trustii->setName('Trustii');
        $trustii = $this->objLayer->findTeam($trustii)->current();

        //echo 'testUpdateTeam ' . var_dump($trustii);
        //update
        $trustii->setName('Trustii-UPDATED');

        //store
        $this->objLayer->storeTeam($trustii);
        echo '

        teams queried, updated, and stored in persistent database successfully

        ';
    }

    public function testUpdateMatch(){
        $match = $this->objLayer->createMatch();
        $match->setHomePoints(30);
        $match->setAwayPoints(29);
        $match->setIsCompleted(true);
        $match = $this->objLayer->findMatch($match)->current();

        //update
        $match->setHomePoints(1000);
        $match->setAwayPoints(10000);
        
        //store
        $this->objLayer->storeMatch($match);
        echo '

        Match queried, updated, and stored in persistent database successfully

        ';
    }
    public function testUpdateScoreReport(){
        $scoreReport = $this->objLayer->createScoreReport();
        $scoreReport->setHomePoints(30);
        $scoreReport->setAwayPoints(21);
        $scoreReport = $this->objLayer->findScoreReport($scoreReport)->current();
        //update
        $scoreReport->setHomePoints(1000);
        $scoreReport->setAwayPoints(1000);
        $scoreReport->setDate(date('Y-m-d H:i:s', time()));
        
        //store
        $this->objLayer->storeScoreReport($scoreReport);
        echo '

        report queried, updated, and stored in persistent database successfully

        ';
                                                
    }
    public function testUpdateSportsVenue(){
        $sportsVenue = $this->objLayer->createSportsVenue();
        $sportsVenue->setName($name = 'Field B');
        $sportsVenue = $this->objLayer->findSportsVenue($sportsVenue)->current();
        $sportsVenue->setName('Field C');
        $sportsVenue->setAddress('Nowhere land, cambodia');

        $this->objLayer->storeSportsVenue($sportsVenue);
        echo '

        venue queried, updated, and stored in persistent database successfully

        ';
    }

    public function testUpdateRound(){
        $r = $this->objLayer->createRound();
        $r->setNumber(1);
        $r = $this->objLayer->findRound($r)->current();

        $r->setNumber(5555);
        $this->objLayer->storeRound($r);
        echo '

        round queried, updated, and stored in persistent database successfully

        ';
    }
}
