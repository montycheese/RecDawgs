<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/26/16
 * Time: 10:16
 */
include("includes/header.php");
//todo show the round# of the match, the league, the teams, and the scores(if the game has played), the date, etc.

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;


if(!isset($_POST) || !isset($_POST['matchId'])){
    $errorMsg  = urlencode("match not found.");
    header("Location: team.php?status={$errorMsg}");
}
?>

<body>
<?php
$matchUI = new Presentation\MatchUI();
echo $matchUI->listMatchInfo();
?>

</body>
</html>