<?php include('includes/header.php');
//todo -
//show a simple form with 2 fields, one for home score and one for away score
//****later- also add logic to prevent non captains of the matches from inputting score.
////form should send user to doEnterMatchScore.php
?>

<body>
<div class="container">
    <h3>Enter Match Score</h3>
    <br>
    
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
            <input type="submit" name="Submit">
        </div>

        </form>
    </p>
</div>
</body>



