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
        //create
        $this->league1 = $this->objLayer->createLeague(
            'Indoor Soccer',
            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
            '3 referees, no handballs, goalie can not pick up team mate passback',
            true,
            4,
            24,
            5,
            8
        );
        $this->league2 = $this->objLayer->createLeague(
            'Curling',
            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
            true,
            4,
            24,
            2,
            100
        );
        //store

        $this->objLayer->storeLeague($this->league1);
        $this->objLayer->storeLeague($this->league2);
        echo 'leagues created and stored in persistent database successfully';
    }

    public function testUpdateTeam(){
        //create
        $this->team1 = $this->objLayer->createTeam('Trustii', $this->student1,$this->league1);
        $this->team2 = $this->objLayer->createTeam('Rockets', $this->student2,$this->league2);

        //store
        $this->objLayer->storeTeam($this->team1);
        $this->objLayer->storeTeam($this->team2);
        echo 'teams created and stored in persistent database successfully';
    }

    public function testUpdateMatch(){

    }
    public function testUpdateScoreReport(){

    }
    public function testUpdateSportsVenue(){

    }

    public function testUpdateRound(){

    }
}
