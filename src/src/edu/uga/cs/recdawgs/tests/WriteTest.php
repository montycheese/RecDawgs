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

class WriteTest extends \PHPUnit_Framework_TestCase {
    private $persistenceLayer = null;
    private $objLayer = null;
    private $student1, $student2, $student3;
    private $team1, $team2, $team3;
    private $league1, $league2, $league3;
    private $match1, $match2, $match3;
    private $venue1, $venue2, $venue3;
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
    }



}