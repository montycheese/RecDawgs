<?php include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;
?>

<body>
    <div class="container">
        <h3>My Teams</h3>
        
        <select name="teams" id="teams">
            <option value="-1">---SELECT TEAM TO VIEW---</option>
            <?php
            $teamUI = new Presentation\TeamUI();
            echo $teamUI->listAllContainingStudent(null, $_SESSION['userId']);?>
        </select>

    </div>
</body>
</html>