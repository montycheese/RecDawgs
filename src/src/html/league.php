<?php 
include('includes/header.php');

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;


if(!isset($_POST) || !isset($_POST['leagueId'])){
    $errorMsg  = urlencode("League not found.");
    header("Location: leagues.php?status={$errorMsg}");
}
$leagueId = $_POST['leagueId'];
$leagueUI = new Presentation\LeagueUI();
$leagueObj = $leagueUI->getLeague($leagueId);
?>

<body><div class="container">
    <h1><?php echo $leagueObj->getName();?></h1><br/>
    <h2>League Info</h2>
    <?php echo $leagueUI->listInfo(null, $leagueId);?>

   <?php
   if($_SESSION['userType'] == 0){
       echo "<h3>Select a team in this league to join</h3><form method='POST' action='php/doJoinTeam.php'>";
   }
   else if ($_SESSION['userType'] == 1){
       echo "<h3>View teams in this league</h3><form method='POST' action='team.php'>";
   }
    ?>
        <div class="form-group">
            <select name="teamId" id="teams">
                <option value="-1">---SELECT TEAM---</option>
                <?php
                echo $leagueUI->listAllTeams($leagueObj);
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value = "Submit">
        </div>
    </form>
    
    <br>

    <h1>Create a Team under this League</h1>

    <form id="createTeam" action="php/doCreateTeam.php" method="post">
        <input name="leagueId" id="leagueId" type="hidden" value="<?php echo $leagueId ?>">
        <input name="teamCaptainId" id="teamCaptainId" type="hidden" value="<?php echo $_SESSION['userId'] ?>">

        <div class="form-group">
            <label for="teamName">Team Name</label>
            <br>
            <input name="teamName" id="teamName" type="text">
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>

    </form>
   </p>
<br>

    <form id="updateLeague" action="updateLeague.php" method="post">
        <?php
        if($_SESSION['userType'] == 1) {
            echo $leagueUI->listUpdateButton(null, $leagueId);
        }
        ?>
    </form>
    
    <form id="deleteLeague" action="php/doDeleteLeague.php" method="post">
        <?php
            if($_SESSION['userType'] == 1) {
                echo $leagueUI->listDeleteButton(null, $leagueId);
            }
        ?>
    </form>
</div>
</body>

<?php include('includes/footer.php'); ?>