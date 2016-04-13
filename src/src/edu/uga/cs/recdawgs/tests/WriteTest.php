<?php
/**
 * Created by PhpStorm.
 * User: mwong
 * Date: 4/11/16
 * Time: 12:41 PM
 */

namespace edu\uga\cs\recdawgs\tests;


use edu\uga\cs\recdawgs\object\impl as Object;
use edu\uga\cs\recdawgs\persistence\impl as Persistence;

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});


class WriteTest extends \PHPUnit_Framework_TestCase {
    private $persistenceLayer = null;
    private $objLayer = null;
    private $student1, $student2;
    private $team1, $team2;
    private $league1, $league2;
    private $match1, $match2;
    private $venue1, $venue2;
    private $round1, $round2;
    private $report1, $report2;

    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
    }

    public function testWriteAdmin(){
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

    public function testWriteStudent(){
        //create as class var to use later when making teams
        $this->student1 = $this->objLayer->createStudent(
            'Montana',
            'Wong',
            'mwong9',
            'youwish',
            'mwong9@uga.edu',
            '12343223',
            'Computer Science',
            '45 Baxter Street Athens, GA 30605'
        );
        $this->student2 = $this->objLayer->createStudent(
            'Bernie',
            'Sanders',
            'feelthebern2016',
            'vermont',
            'bernie@berniesanders.gov',
            'password3232',
            'Politics',
            '123 White Hart Lane, Tottenham, London, England 10001'
        );
        //store
        $this->objLayer->storeStudent($this->student1);
        $this->objLayer->storeStudent($this->student2);
        echo 'students created and stored in persistence database successfully';
    }

    public function testWriteLeague(){
        //create
        $this->league1 = $this->objLayer->createLeague(
            'Indoor Soccer',
            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
            '3 referees, no handballs, goalie can not pick up team mate passback',
            true,
            4,
            24,
            5,
            8,
            null
        );
        $this->league2 = $this->objLayer->createLeague(
            'Curling',
            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
            true,
            4,
            24,
            2,
            100,
            null
        );
        //store
        //echo var_dump($this->league1);
        $this->objLayer->storeLeague($this->league1);
        $this->objLayer->storeLeague($this->league2);
        echo 'leagues created and stored in persistent database successfully';
    }

    /**
     * @depends testWriteStudent
     * @depends testWriteLeague
     */
    public function testWriteTeam(){
        /*create
        if ($this->student1 == null || $this->student2 == null) {
            testWriteStudent();
        }

        if ($this->league1 == null || $this->league2 == null) {
            testWriteLeague();
        }*/


        $this->team1 = $this->objLayer->createTeam('Trustii', $this->student1,$this->league1);
        $this->team2 = $this->objLayer->createTeam('Rockets', $this->student2,$this->league2);

        //store
        $this->objLayer->storeTeam($this->team1);
        $this->objLayer->storeTeam($this->team2);
        echo 'teams created and stored in persistent database successfully';
    }

    /**
     * @depends testWriteStudent
     * @depends testWriteMatch
     */
    public function testWriteScoreReport(){
        /* create
        if ($this->student1 == null || $this->student2 == null) {
            testWriteStudent();
        }

        if ($this->match1 == null || $this->match2 == null) {
            testWriteMatch();
        }*/
        $date = date('Y-m-d H:i:s', time());
        $this->report1 = $this->objLayer->createScoreReport(30, 21, $date, $this->student1, $this->match1);
        $this->report2 = $this->objLayer->createScoreReport(23, 29, $date, $this->student2, $this->match1);

        //store
        $this->objLayer->storeScoreReport($this->report1);
        $this->objLayer->storeScoreReport($this->report2);

        echo 'score report created and stored in persistent database successfully';

    }

    public function testWriteSportsVenue(){
        //create and store
        //if ($this->league1 == null || $this->league2 == null) {
         //   testWriteLeague();
        //}

        $this->venue1 = $this->objLayer->createSportsVenue('Court A', true, 'Ramsey Center, Athens, GA 30605');
        $this->venue2 = $this->objLayer->createSportsVenue('Field B', false, '199 River Road, Athens, GA 30605');
        echo 'sports venues created and stored in persistent database successfully';

    }

    /**
     * @deoebds testWriteLeague
     */
    public function testWriteRound(){
        //create
        //if ($this->league1 == null || $this->league2 == null) {
       //     testWriteLeague();
       // }

        $this->round1 = $this->objLayer->createRound(1, $this->league1);
        $this->round2 = $this->objLayer->createRound(2, $this->league2);

        //store
        $this->objLayer->storeRound($this->round1);
        $this->objLayer->storeRound($this->round2);

        echo 'rounds created and stored in persistent database successfully';

    }

    /**
     * @depends testWriteTeam
     * @depends testWriteLeague
     */
    public function testWriteMatch(){
        //create
       // if ($this->team1 == null || $this->team2 == null) {
        //    testWriteTeam();
       // }
       // if ($this->league1 == null || $this->league2 == null) {
       //     testWriteLeague();
       // }
        $date = date('Y-m-d H:i:s', time());

        $this->match1 = $this->objLayer->createMatch(
                30,
                29,
                $date,
                true,
                $this->team1,
                $this->team2,
                $this->$round1
            );

        $this->match2 = $this->objLayer->createMatch(
                25,
                27,
                $date,
                false,
                $this->team2,
                $this->team1,
                $this->$round2
            );

        // store
        $this->objLayer->storeMatch($this->match1);
        $this->objLayer->storeMatch($this->match2);

        echo 'matches created and stored in persistent database successfully';
    }

    /**
     * @depends testWriteTeam
     * @depends testWriteLeague
     */
    public function testWriteTeamParticipatesInLeague(){
        $this->objLayer->createTeamParticipatesInLeague($this->team1, $this->league1);
        echo 'Team: ' . $this->team1->getName() . ' added to league: ' . $this->league1->getName();
    }

}
