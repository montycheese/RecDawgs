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

    /**
     * WriteTest constructor.
     */
    public function __construct(){
        $this->objLayer = new Object\ObjectLayerImpl(null);
        $this->persistenceLayer = new Persistence\PersistenceLayerImpl(new Persistence\DbConnection(), $this->objLayer);
        $this->objLayer->setPersistence($this->persistenceLayer);
        date_default_timezone_set('America/New_York');
    }

    /**
     * Tests writing all objs to persistence db
     */

    public function testAll(){
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
        echo 'admins created and stored in persistence database successfully.

        ';

        //create as class var to use later when making teams
        $studentA = $this->objLayer->createStudent(
            'Montana',
            'Wong',
            'mwong9',
            'youwish',
            'mwong9@uga.edu',
            '12343223',
            'Computer Science',
            '45 Baxter Street Athens, GA 30605'
        );
        $studentB = $this->objLayer->createStudent(
            'Bernie',
            'Sanders',
            'feelthebern2016',
            'vermont',
            'bernie@berniesanders.gov',
            '810989877',
            'Politics',
            '123 White Hart Lane, Tottenham, London, England 10001'
        );

        $studentC = $this->objLayer->createStudent(
            'Neo',
            'Hao',
            'qianghao',
            'paswordio',
            'nao@uga.edu',
            '810232424',
            'Computer Learning',
            '6969 Baxter Street Athens, GA 30605'
        );
        $studentD = $this->objLayer->createStudent(
            'Ferris',
            'Bueller',
            'Porcheguy123',
            'password123',
            'ferrisbuller@anders.gov',
            '98796656',
            'Math',
            '123 fun lane, Chicago, Illinois 10001'
        );
        //store
        $this->objLayer->storeStudent($studentA);
        $this->objLayer->storeStudent($studentB);
        $this->objLayer->storeStudent($studentC);
        $this->objLayer->storeStudent($studentD);
        //echo var_dump($this->student1);
        echo 'students created and stored in persistence database successfully

        ';

        //create
        $leagueA = $this->objLayer->createLeague(
            'Indoor Soccer',
            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
            '3 referees, no handballs, goalie can not pick up team mate passback',
            true,
            4,
            24,
            5,
            8
        );
        $leagueB = $this->objLayer->createLeague(
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
        $this->objLayer->storeLeague($leagueA);
        $this->objLayer->storeLeague($leagueB);
        echo 'leagues created and stored in persistent database successfully

        ';

        $teamA = $this->objLayer->createTeam('Trustii', $studentA, $leagueA);
        $teamB = $this->objLayer->createTeam('Rockets', $studentB, $leagueA);

        //store
        $this->objLayer->storeTeam($teamA);
        $this->objLayer->storeTeam($teamB);
        echo 'teams created and stored in persistent database successfully

        ';

        $this->objLayer->createStudentCaptainOfTeam($studentA, $teamA);
        $this->objLayer->createStudentCaptainOfTeam($studentB, $teamB);

        $date = date('Y-m-d H:i:s', time());


        $roundA = $this->objLayer->createRound(1, $leagueA);
        $roundB = $this->objLayer->createRound(2, $leagueA);
        $roundC = $this->objLayer->createRound(5, $leagueB);
        $roundD = $this->objLayer->createRound(6, $leagueB);

        //store
        $this->objLayer->storeRound($roundA);
        $this->objLayer->storeRound($roundB);
        $this->objLayer->storeRound($roundC);
        $this->objLayer->storeRound($roundD);
        echo "rounds created and stored in persistent database successfully\n";

        $venueA = $this->objLayer->createSportsVenue('Court A', 'Ramsey Center, Athens, GA 30605', true);
        $venueB = $this->objLayer->createSportsVenue('Field B', '199 River Road, Athens, GA 30605', false);

        $this->objLayer->storeSportsVenue($venueA);
        $this->objLayer->storeSportsVenue($venueB);
        echo 'sports venues created and stored in persistent database successfully

        ';

        $matchA = $this->objLayer->createMatch(
            30,
            29,
            $date,
            true,
            $teamA,
            $teamB,
            $venueA,
            $roundA
        );

        // store
        $this->objLayer->storeMatch($matchA);

        echo "matches created and stored in persistent database successfully\n";

        $reportA = $this->objLayer->createScoreReport(30, 21, $date, $studentA, $matchA);
        $reportB = $this->objLayer->createScoreReport(23, 29, $date, $studentB, $matchA);

        //store
        $this->objLayer->storeScoreReport($reportA);
        $this->objLayer->storeScoreReport($reportB);

        echo "Score report created and stored in persistent database successfully\n";


        $this->objLayer->createTeamParticipatesInLeague($teamA, $leagueA);
        echo 'Team: ' . $teamA->getName() . ' added to league: ' . $leagueA->getName() . '

        ';

        $this->objLayer->createTeamParticipatesInLeague($teamB, $leagueA);
        echo 'Team: ' . $teamB->getName() . ' added to league: ' . $leagueA->getName() . '

        ';

        $this->objLayer->createStudentMemberOfTeam($studentC, $teamA);
        echo '
        Student: ' . $studentC->getFirstName() . ' ' . $studentC->getLastName() . ' added to team: ' . $teamA->getName() . '
            ';
        $this->objLayer->createStudentMemberOfTeam($studentD, $teamB);
        echo '
        Student: ' . $studentD->getFirstName() . ' ' . $studentD->getLastName() . ' added to team: ' . $teamB->getName() . '
        ';

        $this->objLayer->createLeagueSportsVenue($leagueA, $venueA);
        echo "Sports Venue: {$venueA->getName()} added to League: {$leagueA->getName()}\n";
        $this->objLayer->createLeagueSportsVenue($leagueA, $venueB);
        echo "Sports Venue: {$venueB->getName()} added to League: {$leagueA->getName()}\n";
        $this->objLayer->createLeagueSportsVenue($leagueB, $venueA);
        echo "Sports Venue: {$venueA->getName()} added to League: {$leagueB->getName()}\n";
        $this->objLayer->createLeagueSportsVenue($leagueB, $venueB);
        echo "Sports Venue: {$venueB->getName()} added to League: {$leagueB->getName()}\n";
    }

//    public function testWriteAdmin(){
//        //create
//        $john = $this->objLayer->createAdministrator('John', 'Doe', 'jd123', 'password123', 'johndoe@rocketmail.io');
//        $sanath = $this->objLayer->createAdministrator('Sanath', 'Bhat', 'sanathbhat6789', 'somepassword', 'sanath@breakingstuff.com');
//        $maulesh = $this->objLayer->createAdministrator('Maulesh', 'Triveldi', 'ronaldofangirl123', 'iluvronaldo', 'maulesh99@gmail.com');
//        $hillary = $this->objLayer->createAdministrator('Hilary', 'Clinton', 'chillHill', 'whitehouse', 'hillary@whitehouse.edu');
//        //store
//        $this->objLayer->storeAdministrator($john);
//        $this->objLayer->storeAdministrator($sanath);
//        $this->objLayer->storeAdministrator($maulesh);
//        $this->objLayer->storeAdministrator($hillary);
//        echo 'admins created and stored in persistence database successfully.
//        ';
//    }
//
//    public function testWriteStudent(){
//        //create as class var to use later when making teams
//        $this->student1 = $this->objLayer->createStudent(
//            'Montana',
//            'Wong',
//            'mwong9',
//            'youwish',
//            'mwong9@uga.edu',
//            '12343223',
//            'Computer Science',
//            '45 Baxter Street Athens, GA 30605'
//        );
//        $this->student2 = $this->objLayer->createStudent(
//            'Bernie',
//            'Sanders',
//            'feelthebern2016',
//            'vermont',
//            'bernie@berniesanders.gov',
//            'password3232',
//            'Politics',
//            '123 White Hart Lane, Tottenham, London, England 10001'
//        );
//        //store
//        $this->objLayer->storeStudent($this->student1);
//        $this->objLayer->storeStudent($this->student2);
//        //echo var_dump($this->student1);
//        echo 'students created and stored in persistence database successfully
//        ';
//    }

//    public function testWriteLeague(){
//        //create
//        $this->league1 = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//        $this->league2 = $this->objLayer->createLeague(
//            'Curling',
//            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
//            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
//            true,
//            4,
//            24,
//            2,
//            100,
//            null
//        );
//        //store
//        //echo var_dump($this->league1);
//        $this->objLayer->storeLeague($this->league1);
//        $this->objLayer->storeLeague($this->league2);
//        echo 'leagues created and stored in persistent database successfully
//        ';
//    }
//
//    /**
//     * @depends testWriteStudent
//     * @depends testWriteLeague
//     */
//    public function testWriteTeam(){
//        //create
//        //if ($this->student1 == null || $this->student2 == null) {
//         //   testWriteStudent();
//        //}
//
//       // if ($this->league1 == null || $this->league2 == null) {
//        //    testWriteLeague();
//        //}
//
//        //create as class var to use later when making teams
//        $studentA = $this->objLayer->createStudent(
//            'Montana',
//            'Wong',
//            'mwong9',
//            'youwish',
//            'mwong9@uga.edu',
//            '12343223',
//            'Computer Science',
//            '45 Baxter Street Athens, GA 30605'
//        );
//        $studentB = $this->objLayer->createStudent(
//            'Bernie',
//            'Sanders',
//            'feelthebern2016',
//            'vermont',
//            'bernie@berniesanders.gov',
//            'password3232',
//            'Politics',
//            '123 White Hart Lane, Tottenham, London, England 10001'
//        );
//
//        //create
//        $leagueA = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//        $leagueB = $this->objLayer->createLeague(
//            'Curling',
//            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
//            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
//            true,
//            4,
//            24,
//            2,
//            100,
//            null
//        );
//
//        $this->team1 = $this->objLayer->createTeam('Trustii', $studentA, $leagueA);
//        $this->team2 = $this->objLayer->createTeam('Rockets', $studentB, $leagueB);
//
//        //store
//        $this->objLayer->storeTeam($this->team1);
//        $this->objLayer->storeTeam($this->team2);
//        echo 'teams created and stored in persistent database successfully
//        ';
//    }
//
//    /**
//     *
//     */
//    public function testWriteScoreReport(){
//        $leagueA = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//
//        $roundA = $this->objLayer->createRound(1, $leagueA);
//
//        $studentA = $this->objLayer->createStudent(
//            'Montana',
//            'Wong',
//            'mwong9',
//            'youwish',
//            'mwong9@uga.edu',
//            '12343223',
//            'Computer Science',
//            '45 Baxter Street Athens, GA 30605'
//        );
//        $studentB = $this->objLayer->createStudent(
//            'Bernie',
//            'Sanders',
//            'feelthebern2016',
//            'vermont',
//            'bernie@berniesanders.gov',
//            'password3232',
//            'Politics',
//            '123 White Hart Lane, Tottenham, London, England 10001'
//        );
//
//
//        $teamA = $this->objLayer->createTeam('Trustii', $studentA, $leagueA);
//        $teamB = $this->objLayer->createTeam('Rockets', $studentB, $leagueA);
//        $this->objLayer->createStudentCaptainOfTeam($studentA, $teamA);
//        $this->objLayer->createStudentCaptainOfTeam($studentB,$teamB);
//
//        $date = date('Y-m-d H:i:s', time());
//
//        $matchA = $this->objLayer->createMatch(
//            30,
//            29,
//            $date,
//            true,
//            $teamA,
//            $teamB,
//            $roundA
//        );
//
//
//        $date = date('Y-m-d H:i:s', time());
//        $this->report1 = $this->objLayer->createScoreReport(30, 21, $date, $studentA, $matchA);
//        $this->report2 = $this->objLayer->createScoreReport(23, 29, $date, $studentB, $matchA);
//
//        //store
//        $this->objLayer->storeScoreReport($this->report1);
//        $this->objLayer->storeScoreReport($this->report2);
//
//        echo 'score report created and stored in persistent database successfully
//        ';
//
//    }
//
//    public function testWriteSportsVenue(){
//
//
//        $this->venue1 = $this->objLayer->createSportsVenue('Court A', true, 'Ramsey Center, Athens, GA 30605');
//        $this->venue2 = $this->objLayer->createSportsVenue('Field B', false, '199 River Road, Athens, GA 30605');
//
//        $this->objLayer->storeSportsVenue($this->venue1);
//        $this->objLayer->storeSportsVenue($this->venue2);
//        echo 'sports venues created and stored in persistent database successfully
//        ';
//
//    }
//
//    /**
//     * @depends testWriteLeague
//     */
//    public function testWriteRound(){
//        //create
//        //if ($this->league1 == null || $this->league2 == null) {
//       //     testWriteLeague();
//       // }
//        //create
//        $leagueA = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//        $leagueB = $this->objLayer->createLeague(
//            'Curling',
//            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
//            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
//            true,
//            4,
//            24,
//            2,
//            100,
//            null
//        );
//
//        $this->round1 = $this->objLayer->createRound(1, $leagueA);
//        $this->round2 = $this->objLayer->createRound(2, $leagueB);
//
//        //store
//        $this->objLayer->storeRound($this->round1);
//        $this->objLayer->storeRound($this->round2);
//
//        echo 'rounds created and stored in persistent database successfully\n';
//
//    }
//
//    /**
//     * @depends testWriteTeam
//     * @depends testWriteLeague
//     */
//    public function testWriteMatch(){
//        $leagueA = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//        $leagueB = $this->objLayer->createLeague(
//            'Curling',
//            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
//            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
//            true,
//            4,
//            24,
//            2,
//            100,
//            null
//        );
//
//        $roundA = $this->objLayer->createRound(1, $leagueA);
//        $roundB = $this->objLayer->createRound(2, $leagueA);
//
//        $studentA = $this->objLayer->createStudent(
//            'Montana',
//            'Wong',
//            'mwong9',
//            'youwish',
//            'mwong9@uga.edu',
//            '12343223',
//            'Computer Science',
//            '45 Baxter Street Athens, GA 30605'
//        );
//        $studentB = $this->objLayer->createStudent(
//            'Bernie',
//            'Sanders',
//            'feelthebern2016',
//            'vermont',
//            'bernie@berniesanders.gov',
//            'password3232',
//            'Politics',
//            '123 White Hart Lane, Tottenham, London, England 10001'
//        );
//
//
//        $teamA = $this->objLayer->createTeam('Trustii', $studentA, $leagueA);
//        $teamB = $this->objLayer->createTeam('Rockets', $studentB, $leagueA);
//
//
//        $date = date('Y-m-d H:i:s', time());
//        $venueA = $this->objLayer->createSportsVenue('Court A', true, 'Ramsey Center, Athens, GA 30605');
//        $venueB = $this->objLayer->createSportsVenue('Field B', false, '199 River Road, Athens, GA 30605');
//
//        $this->match1 = $this->objLayer->createMatch(
//                30,
//                29,
//                $date,
//                true,
//                $teamA,
//                $teamB,
//                $venueA,
//                $roundA
//            );
//
//        $this->match2 = $this->objLayer->createMatch(
//                25,
//                27,
//                $date,
//                false,
//                $teamB,
//                $teamA,
//               $venueA,
//                $roundB
//            );
//
//        // store
//        $this->objLayer->storeMatch($this->match1);
//        $this->objLayer->storeMatch($this->match2);
//
//        echo 'matches created and stored in persistent database successfully
//        ';
//    }
//
//    /**
//     * @depends testWriteTeam
//     * @depends testWriteLeague
//     */
//    public function testWriteTeamParticipatesInLeague(){
//        $leagueA = $this->objLayer->createLeague(
//            'Indoor Soccer',
//            'Games only played indoor. Must be soccer rules adhereing to fifa guidelines.',
//            '3 referees, no handballs, goalie can not pick up team mate passback',
//            true,
//            4,
//            24,
//            5,
//            8,
//            null
//        );
//        $leagueB = $this->objLayer->createLeague(
//            'Curling',
//            'Games only played on ice. Rules adhere to Winter Olympic games standards CIE2.0.',
//            '3 referees, sticks must be approved by judges, puck must be lightweight uranium',
//            true,
//            4,
//            24,
//            2,
//            100,
//            null
//        );
//
//        $studentA = $this->objLayer->createStudent(
//            'Montana',
//            'Wong',
//            'mwong9',
//            'youwish',
//            'mwong9@uga.edu',
//            '12343223',
//            'Computer Science',
//            '45 Baxter Street Athens, GA 30605'
//        );
//        $studentB = $this->objLayer->createStudent(
//            'Bernie',
//            'Sanders',
//            'feelthebern2016',
//            'vermont',
//            'bernie@berniesanders.gov',
//            'password3232',
//            'Politics',
//            '123 White Hart Lane, Tottenham, London, England 10001'
//        );
//
//
//        $teamA = $this->objLayer->createTeam('Trustii', $studentA, $leagueA);
//        $teamB = $this->objLayer->createTeam('Rockets', $studentB, $leagueB);
//
//        $this->objLayer->createTeamParticipatesInLeague($teamA, $leagueA);
//        echo 'Team: ' . $teamA->getName() . ' added to league: ' . $leagueA->getName();
//    }

}
