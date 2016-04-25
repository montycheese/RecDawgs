<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/25/16
 * Time: 15:01
*/
include("includes/header.php");
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});

use edu\uga\cs\recdawgs\presentation as Presentation;
?>


<body>
<div class="container">
    <h1><?php echo "{$_SESSION['firstName']} {$_SESSION['lastName']}'s";?> Profile page </h1>


    <p>
    Welcome to your profile page.
    </p>


</div>
</body>
</html>