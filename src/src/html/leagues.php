<?php include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;

?>


<body>
<div class="container">
<h1>All Leagues</h1>

    <form action="league.php" method="post">
        <div class="form-group">
            <select name="leagueId" id="leagueId">
                <option value="-1">---SELECT LEAGUE TO VIEW---</option>
                    <?php
                        //echo var_dump($_SESSION);
                     $leagueUI = new Presentation\LeagueUI();
                     echo $leagueUI->listAll();
                    ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="View team">
        </div>
    </form>
    
    

    <br/>

    <?php if($_SESSION['userType'] == 1){echo $leagueUI->listCreateButton();}?>
   <br/>

    <?php echo ($_SESSION['userType'] == 1) ? $leagueUI->listCloseEnrollmentButton() : "";?>
</div>
</body>

<?php include('includes/footer.php'); ?>