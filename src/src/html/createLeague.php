<?php include('includes/header.php')?>

<body>
<div class="container">
    <h3>Create League</h3>
    <br>

    <p>
    <form id="createLeague" action="php\createLeague.php" method="post">
        <div class="form-group">
            <label for="leagueName">League Name</label>
            <br>
            <input name="name" id="leagueName" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="leagueRules">League Rules</label>
            <br>
            <input name="leagueRules" id="leagueRules" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="matchRules">Match Rules</label>
            <br>
            <input name="matchRules" id="matchRules" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="isIndoor">Indoor?</label>
            <br>
            <input name="isIndoor" id="isIndoor" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="minTeams">Minimum Number of Teams</label>
            <br>
            <input name="matchRules" id="matchRules" type="text" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="maxTeams">Minimum Number of Teams</label>
            <br>
            <input name="maxTeams" id="maxTeams" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="minMembers">Minimum Number of Members on a Team</label>
            <br>
            <input name="minMembers" id="minMembers" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

        <div class="form-group">
            <label for="maxMembers">Maximum Number of Members on a Team</label>
            <br>
            <input name="maxMembers" id="maxMembers" type="text" pattern="[A-z]{1,}" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>

    </form>
    </p>

</div>

</body>
