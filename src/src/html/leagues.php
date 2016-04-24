<?php include('includes/header.php'); ?>


<body>
<div class="container">
<h1>Leagues</h1>

    <h3>Indoor:</h3>

    <?php
    $leagueUI = new Presentation\LeagueUI();
    echo $leagueUI->listIndoor();
    ?>

    <h3>Outdoor:</h3>

    <?php
    $leagueUI = new Presentation\LeagueUI();
    echo $leagueUI->listOutdoor();
    ?>
   
</div>
</body>
</html>