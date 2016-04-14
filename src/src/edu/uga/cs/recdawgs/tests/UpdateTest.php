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

    /**
     * UpdateTest constructor.
     */
    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    /**
     * Tests updating admin objs from persistence db
     */

    public function testUpdateAdmin(){
        //create
        $john = $this->objLayer->createAdministrator();
        $oldUserName = 'jd123';
        $newUserName = 'JOHNDOE123';
        $john->setUserName($oldUserName);
        $john = $this->objLayer->findAdministrator($john)->current();

        $john->setUserName($newUserName);

        //store
        $this->objLayer->storeAdministrator($john);

        echo "\nAdmin {$john->getFirstName()} {$john->getLastName()} has updated username from {$oldUserName} to {$newUserName}\n";
    }

    /**
     * Tests updating student objs from persistence db
     */

    public function testUpdateStudent(){
        $oldUserName = 'mwong9';
        $newUserName = 'montycheese';
        $oldEmailAddress = "mwong9@uga.edu";
        $newEmailAddress = "montanawong@gmail.com";

        $montana = $this->objLayer->createStudent();
        $montana->setFirstName("Montana");
        $montana->setLastName("Wong");
        $montana->setUserName($oldUserName);

        // update
        $montana = $this->objLayer->findStudent($montana)->current();
        $montana->setUserName($newUserName);
        $montana->setEmailAddress('montanawong@gmail.com');

        //store
        $this->objLayer->storeStudent($montana);
        echo "\nStudent {$montana->getFirstName()} {$montana->getLastName()} has updated username from {$oldUserName} to {$newUserName}\n";
        echo "and updated email address from {$oldEmailAddress} to {$newEmailAddress}\n";

    }


    public function testUpdateRound(){
        $oldNumber = 1;
        $newNumber = 5555;

        $r = $this->objLayer->createRound();
        $r->setNumber($oldNumber);
        $r = $this->objLayer->findRound($r)->current();
        $r->setNumber($newNumber);
        $this->objLayer->storeRound($r);
        echo "\nRound with number: {$oldNumber} has updated it's number to {$newNumber}\n";
    }

    public function testUpdateScoreReport(){
        $oldHomePoints = 23;
        $newHomePoints = 24;
        $oldAwayPoints = 29;
        $newAwayPoints = 5;
        //create model score report
        $sr = $this->objLayer->createScoreReport();
        $sr->setHomePoints($oldHomePoints);
        $sr->setAwayPoints($oldAwayPoints);
        //find acutal score report
        $sr = $this->objLayer->findScoreReport($sr)->current();

        $sr->setHomePoints($newHomePoints);
        $sr->setAwayPoints($newAwayPoints);

        echo "\nScore report with id: {$sr->getId()}\n";
        echo "updated it's home points from {$oldHomePoints} to {$newHomePoints} \n";
        echo "and updated it's away points from {$oldAwayPoints} to {$newAwayPoints} \n";
    }

    //EVERYTHING UNDER THIS IS TODO FOLLOW EXAMPLE AS ABOVE
    /**
     * Tests updating league objs from persistence db
     */

    public function testUpdateLeague(){
        //query
        $soccer = $this->objLayer->createLeague();
        $soccer->setName('Indoor Soccer');
        $soccer->setIsIndoor(true);
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

    /**
     * Tests updating team objs from persistence db
     */

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


    /**
     * Tests updating admin objs from persistence db
     */

    public function testUpdateSportsVenue(){
        $sportsVenue = $this->objLayer->createSportsVenue();
        $sportsVenue->setName('Field B');
        $sportsVenue = $this->objLayer->findSportsVenue($sportsVenue)->current();
        $sportsVenue->setName('Field C');
        $sportsVenue->setAddress('Nowhere land, cambodia');

        $this->objLayer->storeSportsVenue($sportsVenue);
        echo '

        venue queried, updated, and stored in persistent database successfully

        ';
    }




}
