<?php 
include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;

if(!isset($_POST) || !isset($_POST['teamId'])){
    $errorMsg  = urlencode("Team not found.");
    header("Location: teams.php?status={$errorMsg}");
}
$teamId = $_POST['teamId'];
$teamUI = new Presentation\TeamUI();
$teamObj = $teamUI->getTeam($teamId);
$leagueId = $teamObj->getParticipatesInLeague()->getId();

$matchUI = new Presentation\MatchUI();

?>

<body>
<?php

echo $teamUI->listTeamInformation(null, $teamId);
?>

<?php
//only allow updating team if the user is team captain
if($teamObj->getCaptain()->getId() == $_SESSION['userId']) {
    echo "<h3>Update Team Information </h3>
    <form method='POST' action='php/doUpdateTeam.php'>
    <label for='teamName'>Team Name</label>
    <input name='teamName' placeholder='New Team name'>
        <input name='teamId' id='teamId' type='hidden' value='{$teamId}'>
        <input name='leagueId' id='leagueId' type='hidden' value='{$leagueId}'
    <p>
            <input type='submit' value = 'Update Team'>
        </p>
    </form>";

    echo  "<br/><h3>Delete Team (Unreversable)</h3><br/>
        <form method='POST' action='php/doDeleteTeam.php'>
        <input name='teamId' id='teamId' type='hidden' value='{$teamId}'>
        <p>
            <input type='submit' value = 'Delete Team'>
        </p>
    </form>";
}
?>

    <?php
        echo $matchUI->listUpcomingMatches($teamObj);
    ?>
</body>


<?php include('includes/footer.php'); ?>