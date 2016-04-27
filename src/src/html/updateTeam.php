<?php 
include('includes/header.php');
$theTeamID = $_POST['teamId'];
?>

<body>
<div class="container">
    <h3>Update Team</h3>
    <br>

    <p>
    <form id="createTeam" action="php/doCreateTeam.php" method="post">
        <input name="teamID" id="teamID" type="hidden" value="<?php echo $theTeamID ?>">


        <div class="form-group">
            <label for="teamname">Team Name</label>
            <br>
            <input name="teamname" id="teamname" type="text" pattern="[A-z]{1,}">
        </div>

        <div class="form-group">
            <label for="userid">Team Captain</label>
            <br>
            <select name="userid" id="userid">
                <option value="-1">---SELECT USER TO VIEW---</option>
            </select>
        </div>

        <div class="form-group">
            <label for="leagueid">League</label>
            <br>
            <select name="leagueid" id="leagueid">
                <option value="-1">---SELECT LEAGUE TO VIEW---</option>
            </select>
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>

    </form>
    </p>

</div>

</body>

<?php include('includes/footer.php'); ?>