<?php include('includes/header.php');
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/src/' . str_replace('\\', '/', $class_name) .'.php';
});
use edu\uga\cs\recdawgs\presentation as Presentation;
?>

<body>
    <div class="container">
        <h3>My Teams</h3>
        <form action="team.php" method="post">
        <select name="teamId" id="teamId">
            <option value="-1">---SELECT TEAM TO VIEW---</option>
            <?php
            $teamUI = new Presentation\TeamUI();
            echo $teamUI->listAllContainingStudent(null, $_SESSION['userId']);?>
        </select>
            <br/>
            <input type="submit" value="View team">
        </form>

    </div>
</body>
</html>