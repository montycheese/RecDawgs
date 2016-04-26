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

</body>