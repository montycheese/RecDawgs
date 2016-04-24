
<?php 
include('includes/header.php'); 
?>


<body>
<div class="container">
<h1>Leagues</h1>

    <h3>Indoor:</h3>

    <?php
    // to do: check the indoor type
    $leagueModel = $_SESSION['logicLayer']->createLeague(
    null, null, null, True, null, null, null, null);

    $leaguesIndoor = $_SESSION['logicLayer']->findLeague($leagueModel);

    $leagueIndoor = $leaguesIndoor->current();

    if ($leaguesIndoor->size() == 0) {
        echo "<p>No indoor leagues</p>";
    } else {
        echo '<form method="POST" action="league.php">';
        echo '<select class="form-control">';

        while ($leagueIndoor != null) {
            $leagueName = $leagueIndoor->getName();
            echo '<option value = "'.$leagueName.'">'.$leagueName.'</option>';
            $leagueIndoor = $leaguesIndoor->next();
        }

        echo '</select>';
        echo '<p><input type="submit" value = "Select League"></p>';
        echo '</form>';
    }
    ?>

    <h3>Outdoor:</h3>

    <?php
    // to do: check the indoor type
    $leagueModel = $_SESSION['logicLayer']->createLeague(
    null, null, null, False, null, null, null, null);

    $leaguesIndoor = $_SESSION['logicLayer']->findLeague($leagueModel);

    $leagueIndoor = $leaguesIndoor->current();

    if ($leaguesIndoor->size() == 0) {
        echo "<p>No outdoor leagues</p>";
    } else {
        echo '<form method="POST" action="league.php">';
        echo '<select class="form-control">';

        while ($leagueIndoor != null) {
            $leagueName = $leagueIndoor->getName();
            echo '<option value = "'.$leagueName.'">'.$leagueName.'</option>';
            $leagueIndoor = $leaguesIndoor->next();
        }

        echo '</select>';
        echo '<p><input type="submit" value = "Select League"></p>';
        echo '</form>';
    }
    ?>
   
</div>
</body>