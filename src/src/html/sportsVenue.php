<?php

include("includes/header.php");

//session_start();
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;
use edu\uga\cs\recdawgs\entity\impl as Entity;


if(!isset($_POST) || !isset($_POST['sportsVenueId'])){
    $errorMsg  = urlencode("Sports Venue not found.");
    header("Location: sportsVenues.php?status={$errorMsg}");
}
?>

<body>
<div class="container">
<?php
$sportsVenueId = $_POST['sportsVenueId'];
$sportsVenueModel = new Entity\SportsVenueImpl();
$sportsVenueModel->setId($sportsVenueId);
$sportsVenueUI = new Presentation\SportsVenueUI();
echo $sportsVenueUI->listSportsVenueInfo($sportsVenueModel);

echo "<h2>Leagues used in</h2>";
echo $sportsVenueUI->listLeaguesUsedIn(null, $sportsVenueId);
?>

<br/><br/>
<?php
//if admin allow update and deletion of sports venues and assignment to league
if($_SESSION['userType']== 1) {
    echo $sportsVenueUI->listAddToLeagueButton($sportsVenueId);

   echo "<h3>Update Sports Venue</h3><br/><form action = 'updateSportsVenue.php' method = 'post' >
    <input type = 'hidden' name = 'sportsVenueId' value = '{$sportsVenueId}'>
        <input type ='submit' value ='Update the Sports Venue'>
</form >";
}

if($_SESSION['userType']== 1) {
   echo "<h3>Delete Sports Venue</h3><br/><form action = 'php/doDeleteSportsVenue.php' method = 'post'>
    <input type = 'hidden' name = 'userId' value = '{$_SESSION['userId']}'>
    <input type = 'hidden' name = 'sportsVenueId' value = '{$sportsVenueId}'>
        <input type ='submit' value ='Delete the Sports Venue'>
</form >";
}
?>
</div>
</body>

<?php include('includes/footer.php'); ?>