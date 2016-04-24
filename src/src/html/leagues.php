<?php include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;

?>


<body>
<div class="container">
<h1>Leagues</h1>

    <h3>All:</h3>

    <?php
    //echo var_dump($_SESSION);
    $leagueUI = new Presentation\LeagueUI();
    echo $leagueUI->listIndoor();
    ?>

    <h3>Outdoor:</h3>

    <?php
    //leagueUI = new Presentation\LeagueUI();
    //echo $leagueUI->listOutdoor();
    ?>
   
</div>
</body>
</html>