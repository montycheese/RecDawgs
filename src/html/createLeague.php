<?php 
include('includes/header.php'); 
?>

<body>
<div class="container">
    <h3>Create League</h3>
    <br>

    <p>
    <form id="createLeague" action="php/doCreateLeague.php" method="post">
        <div class="form-group">
            <label for="leagueName">League Name</label>
            <br>
            <input name="name" id="leagueName" type="text"   required>
        </div>

        <div class="form-group">
            <label for="leagueRules">League Rules</label>
            <br>
            <!--<input name="leagueRules" id="leagueRules" type="textarea"   required>-->
            <textarea name="leagueRules" id="leagueRules" cols="50" rows="5" wrap="soft"></textarea>
        </div>

        <div class="form-group">
            <label for="matchRules">Match Rules</label>
            <br>
            <!--<input name="matchRules" id="matchRules" type="text"   required>-->
            <textarea name="matchRules" id="leagueRules" cols="50" rows="5" wrap="soft"></textarea>
        </div>

        <div class="form-group">
            <label for="minTeams">Minimum Number of Teams</label>
            <br>
            <input name="minTeams" id="minTeams" type="text" required>
        </div>

        <div class="form-group">
            <label for="maxTeams">Maximum Number of Teams</label>
            <br>
            <input name="maxTeams" id="maxTeams" type="text"   required>
        </div>

        <div class="form-group">
            <label for="minMembers">Minimum Number of Members on a Team</label>
            <br>
            <input name="minMembers" id="minMembers" type="text"   required>
        </div>

        <div class="form-group">
            <label for="maxMembers">Maximum Number of Members on a Team</label>
            <br>
            <input name="maxMembers" id="maxMembers" type="text"   required>
        </div>

        <div class="form-group">
            <label for="venueType">Indoor or Outdoor?</label>
            <br>
            <select name="isIndoor" id="isIndoor"> 
                <option value="1">Indoor</option>
                <option value="0">Outdoor</option>
            </select>
        </div>

        <div class="form-group">
            <input style="form-control" type="submit" name="Create A League">
        </div>

    </form>
    </p>

</div>

</body>

<?php include('includes/footer.php'); ?>