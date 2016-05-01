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
    include '/Users/montanawong/Sites/RecDawgs/src/' . str_replace('\\', '/', $class_name) .'.php';
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
        echo "\nUpdating an Administrator object:\n";
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
        echo "\nUpdating a Student object:\n";

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
        echo "\nUpdating a Round object:\n";

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
        echo "\nUpdating a Score Report object:\n";
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
        $this->objLayer->storeScoreReport($sr);
        echo "\nScore report with id: {$sr->getId()}\n";
        echo "updated it's home points from {$oldHomePoints} to {$newHomePoints} \n";
        echo "and updated it's away points from {$oldAwayPoints} to {$newAwayPoints} \n";
    }

    //EVERYTHING UNDER THIS IS TODO FOLLOW EXAMPLE AS ABOVE
    /**
     * Tests updating league objs from persistence db
     */

    public function testUpdateLeague(){
        echo "\nUpdating an League object:\n";
        //query
        $oldMinTeams = 4;
        $oldMaxTeams = 24;
        $oldMinMembers = 0;
        $oldMaxMembers = 0;
        $newMinTeams = 4;
        $newMaxTeams = 24;
        $newMinMembers = 0;
        $newMaxMembers = 0;

        $soccer = $this->objLayer->createLeague();
        $soccer->setName('Indoor Soccer');
        $soccer->setIsIndoor(true);
        $soccer = $this->objLayer->findLeague($soccer)->current();

        //update
        $soccer->setMinTeams($newMinTeams);
        $soccer->setMaxTeams($newMaxTeams);
        $soccer->setMinMembers($newMinMembers);
        $soccer->setMaxMembers($newMaxMembers);

        //store
        $this->objLayer->storeLeague($soccer);

        echo "\nLeague with name: {$soccer->getName()}\n";
        echo "has updated it's minimum team from {$oldMinTeams} to {$newMinTeams} \n";
        echo "and updated it's maximum team from {$oldMaxTeams} to {$newMaxTeams} \n";
        echo "and updated it's minimum amount of members from {$oldMinMembers} to {$newMinMembers} \n";
        echo "and updated it's maximum amount of members from {$oldMaxMembers} to {$newMaxMembers} \n";
        /*echo '

        leagues queried, updated, and stored in persistent database successfully

        ';*/
    }

    /**
     * Tests updating team objs from persistence db
     */

   public function testUpdateTeam(){
        echo "\nUpdating a Team object:\n";
        $oldName = 'Trustii';
        $newName = 'Maximum Ride';
        $trustii = $this->objLayer->createTeam();
        $trustii->setName($oldName);
        $trustii = $this->objLayer->findTeam($trustii)->current();

        //echo 'testUpdateTeam ' . var_dump($trustii);
        //update
        $trustii->setName($newName);

        //store
        $this->objLayer->storeTeam($trustii);



       echo "\nTeam {$oldName} has updated their name from {$oldName} to {$newName}\n";
       /* echo '

        teams queried, updated, and stored in persistent database successfully

        ';*/
    }


    /**
     * Tests updating admin objs from persistence db
     */

    /*public function testUpdateSportsVenue(){
        echo "\nUpdating a Sports Venue object:\n";
        $oldName = 'Field B';
        $oldAddress = '199 River Road, Athens, GA 30605';
        $newName = 'Field C';
        $newAddress = 'Nowhere Land, Cambodia';


        $sportsVenue = $this->objLayer->createSportsVenue();
        $sportsVenue->setName($oldName);
        $sportsVenue = $this->objLayer->findSportsVenue($sportsVenue)->current();
        $sportsVenue->setName($newName);
        $sportsVenue->setAddress($newAddress);

        $this->objLayer->storeSportsVenue($sportsVenue);

        echo "\nThe sports venue {$oldName} at {$oldAddress} has been updated its name to {$newName} and its address to {$newAddress}\n";
        /*echo '

        venue queried, updated, and stored in persistent database successfully

        ';
    } */




}
