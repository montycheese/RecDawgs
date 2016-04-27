<?php

include("includes/header.php");

spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;
use edu\uga\cs\recdawgs\entity\impl as Entity;


if(!isset($_POST) || !isset($_POST['sportsVenueId'])){
    $errorMsg  = urlencode("Sports Venue not found.");
    //header("Location: .php?status={$errorMsg}");
}
?>

<body>
<?php
$sportsVenueId = $_POST['sportsVenueId'];
$sportsVenueModel = new Entity\SportsVenueImpl();
$sportsVenueModel->setId($sportsVenueId);
$sportsVenueUI = new Presentation\SportsVenueUI();
echo $sportsVenueUI->listSportsVenueInfo($sportsVenueModel);
?>

<br/><br/>
<?php
//if admin allow deletion of sports venues
if($_SESSION['userType']== 1) {
   echo "<form action = 'php/doDeleteSportsVenue.php' method = 'post' >
    <input type = 'hidden' name = 'userId' value = '{$_SESSION['userId']}'>
    <input type = 'hidden' name = 'sportsVenueId' value = '{$sportsVenueId}'
        < input type = 'submit' value = 'Delete the Sports Venue' >
</form >";
}
?>
</body>
</html>