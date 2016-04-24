<?php include('includes/header.php')?>

<body>
    <div class="container">
        <h3>My Teams</h3>
        
        <select name="teams" id="teams">
            <option value="-1">---SELECT TEAM TO VIEW---</option>
            <?php
            $teamUI = new Presentation\TeamUI();
            echo $teamUI->listAllContainingStudent($_SESSION['userObject']);?>
        </select>

    </div>
</body>
</html>