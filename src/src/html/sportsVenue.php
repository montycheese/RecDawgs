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
?>

<br/><br/>
<?php
//if admin allow update and deletion of sports venues
if($_SESSION['userType']== 1) {
   echo $sportsVenueUI->listUpdateButton(null, $sportsVenueId);
}

if($_SESSION['userType']== 1) {
   echo $sportsVenueUI->listDeleteButton(null, $sportsVenueId);
}
?>
</div>
</body>

<?php include('includes/footer.php'); ?>