<?php 
include('includes/header.php');
$theLeagueID = $_POST['leagues'];
?>

<body>
    <h1>(League Name)</h1>
    
    <form method="POST" action="php/joinTeam.php"> 
             
        <select name="teams" id="teams">
            <option value="-1">---SELECT TEAM TO VIEW---</option>
            <?php
            $teamUI = new Presentation\TeamUI();
            echo $teamUI->listAll();
            ?>
        </select>
            
        <input type="submit" value = "Join Team"> 
    </form>
    
    <br> <br> <br>

    <h1>Create a Team under this League</h1>

    <form id="createTeam" action="doCreateTeam.php" method="post">
        <input name="league" id="league" type="hidden" value="<?php echo $theLeagueID ?>">
        <input name="teamCap" id="teamCap" type="hidden" value="<?php echo $_SESSION['userId'] ?>">

        <div class="form-group">
            <label for="teamName">Team Name</label>
            <br>
            <input name="name" id="teamName" type="text" pattern="[A-z]{1,}">
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>

    </form>
   </p>

</body>
</html>