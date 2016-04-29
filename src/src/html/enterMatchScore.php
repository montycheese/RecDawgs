<?php include('includes/header.php');
use edu\uga\cs\recdawgs\presentation as Presentation;
//todo -
//show a simple form with 2 fields, one for home score and one for away score
//****later- also add logic to prevent non captains of the matches from inputting score.
////form should send user to doEnterMatchScore.php
if(!isset($_POST) || !isset($_POST['matchId'])){
    $errorMsg = urlencode("invalid match");
    header("Location: match.php?status={$errorMsg}");
}
$matchId = $_POST['matchId'];
?>

<body>
<div class="container">
    <h3>Enter Match Score</h3>
    <br>
    <?php
    $matchUI = new Presentation\MatchUI();
    echo $matchUI->listMatchInfo(null, $matchId);
    ?>
    <p>
        <form id="enterMatchScore" action="php/doEnterMatchScore.php" method="post">

        <div class="form-group">
            <label for="homeTeamScore">Home Team Score</label>
            <br>
            <input name="homeTeamScore" id="homeTeamScore" type="text">
        </div>

        <div class="form-group">
            <label for="awayTeamScore">Away Team Score</label>
            <br>
            <input name="awayTeamScore" id="awayTeamScore" type="text">
        </div>

        <div class="form-group">
            <input type="hidden" name="matchId" value="<?php echo $matchId;?>">
            <input type="submit" name="Submit" value="submit score">
        </div>

        </form>
    </p>
</div>
</body>



