<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/26/16
 * Time: 10:16
 */
//session_start();
include("includes/header.php");
//todo show the round# of the match, the league, the teams, and the scores(if the game has played), the date, etc.

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;


if(!isset($_POST) || !isset($_POST['matchId'])){
    $errorMsg  = urlencode("match not found.");
    header("Location: team.php?status={$errorMsg}");
}

$scoreReportUI = new Presentation\ScoreReportUI();
$numScoreReports = $scoreReportUI->getNumScoreReports($_POST['matchId']);
?>

<body>


    <?php
    $matchUI = new Presentation\MatchUI();
    $homePoints = -1; $awayPoints = -1;
    if($numScoreReports >=2){
        $scores = $scoreReportUI->getScores($_POST['matchId']);
        $homePoints = intval($scores[0]['homeScore']);
        $awayPoints = intval($scores[0]['awayScore']);
        //die(var_dump($scores));
    }
    echo $matchUI->listMatchInfo(null, $_POST['matchId'], $homePoints, $awayPoints);
    echo $scoreReportUI->showMatchReports($_POST['matchId']);
    if($_SESSION['userType'] == 0 && $numScoreReports <= 1){
        echo "<h2>Enter match score</h2> <br/>
    <form action='enterMatchScore.php' method='post'>
        <input type = 'hidden' name = 'matchId' value = '{$_POST['matchId']}'>
    <input type='submit' name='Click here to input match score' id='enterMatchScore'>
    </form>
    <br/>";
    }
    ?>



    <?php if($_SESSION['userType'] == 1 && $numScoreReports >= 2 ){
      //  $scores = $scoreReportUI->getScores($_POST['matchId']);
        //if($scores[0]['homeScore'] != $scores[1]['homeScore'] && $scores[0]['awayScore'] != $scores[1]['awayScore']) {
            $matchUI = new Presentation\MatchUI();
            echo "<h3>Resolve match score</h3>";
            echo $matchUI->listResolveMatchScoreButton($_POST['matchId']);
      //  }
    }?>



</body>
</html>