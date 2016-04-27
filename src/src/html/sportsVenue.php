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

<body>
    <h1><?php echo $leagueObj->getName();?></h1><br/>
    <p>Select a team in this league to join</p>
    
    <form method="POST" action="php/doJoinTeam.php">
        
        <div class="form-group">
            <select name="teams" id="teams">
                <option value="-1">---SELECT TEAM TO VIEW---</option>
                <?php
                echo $leagueUI->listAllTeams($leagueObj);
                ?>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value = "Join Team"> 
        </div>
    </form>
    
    <br>

    <h1>Update Sports Venue</h1>

    <form id="updateSportsVenue" action="php/doUpdateSportsVenue.php" method="post">
        <input name="#" id="#" type="hidden" value="<?php echo # ?>">

        <div class="form-group">
            <label for="teamName">Venue Name</label>
            <br>
            <input name="name" id="teamName" type="text">
        </div>

        <div class="form-group">
            <label for="venueType">Indoor or Outdoor?</label>
            <br>
            <select name="isIndoor" id="isIndoor"> 
                <option value="true">Indoor</option>
                <option value="false">Outdoor</option>
            </select>
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>

    </form>
   </p>

</body>

<?php include('includes/footer.php'); ?>