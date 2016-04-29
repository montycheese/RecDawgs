<?php
/**
 * Created by PhpStorm.
 * User: skhan_731
 * Date: 4/29/2016
 * Time: 2:54 PM
 */
include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;?>


<body>
    <div class="container">
        <h3>Resolve Match Score</h3>
        <br>

        <?php
        $matchUI = new Presentation\MatchUI();
        echo $matchUI->listMatchInfo(null, $_POST['matchId']);
        ?>

        <p>
            <form id="resolveMatchScore" action="php/doResolveMatchScore.php" method="post">

            <div class="form-group">
                <label for="homeTeamScore">New Home Team Score</label>
                <br>
                <input name="homeTeamScore" id="homeTeamScore" type="text">
            </div>

            <div class="form-group">
                <label for="awayTeamScore">New Away Team Score</label>
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