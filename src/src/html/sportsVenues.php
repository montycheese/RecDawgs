<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/28/16
 * Time: 20:11
 */
include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;

$sportsVenueUI = new Presentation\SportsVenueUI();
?>


    <body>
    <div class="container">
        <h1>All Sports Venues</h1>

        <?php
        echo $sportsVenueUI->listAll();
        ?>

        <br/>

        <?php 

        if($_SESSION['userType'] == 1){
            echo $sportsVenueUI->listCreateButton();
            echo '<br>';
            echo $sportsVenueUI->listDeleteButton();
        }

        ?>
        <br/>

        <?php //echo ($_SESSION['userType'] == 1) ? $leagueUI->listCloseEnrollmentButton() : "";?>
    </div>
    </body>

<?php include('includes/footer.php'); ?>