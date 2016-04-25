 <?php include('includes/header.php');?>

<body>
<div class="container">
    <h3>Create Team</h3>
    <br>

    <p>
    <form id="createTeam" action="doCreateTeam.php" method="post">
        <div class="form-group">
            <label for="teamName">Team Name</label>
            <br>
            <input name="name" id="teamName" type="text" pattern="[A-z]{1,}">
        </div>

        <div class="form-group">
            <label for="teamCap">Team Captain</label>
            <br>
            <option value="-1">---SELECT TEAM TO VIEW---</option>
        </div>

        <div class="form-group">
            <label for="league">League</label>
            <br>
            <option value="-1">---SELECT TEAM TO VIEW---</option>
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>

    </form>
    </p>

</div>

</body>
</html>