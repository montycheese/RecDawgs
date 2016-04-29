<?php include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;

?>


<body>
<div class="container">
<h1>All Leagues</h1>

    <?php
    $leagueUI = new Presentation\LeagueUI();
    echo $leagueUI->listAll();
    ?>
    
    

    <br/>

    <?php if($_SESSION['userType'] == 1){echo $leagueUI->listCreateButton();}?>
   <br/>

    <?php echo ($_SESSION['userType'] == 1) ? $leagueUI->listCloseEnrollmentButton() : "";?>
</div>
</body>

<?php include('includes/footer.php'); ?>