<?php
/**
 * Created by PhpStorm.
 * User: skhan731
 * Date: 4/27/2016
 * Time: 11:57 PM
 */

include('includes/header.php');
$leagueId = $_POST['leagueId'];
?>

<body>
    <div class="container">
        <h3>Update League</h3>
        <br>

        <form id="updateLeague" action="php/doUpdateLeague.php" method="post">
            <input type = 'hidden' name = 'leagueId' value = '<?php echo "{$leagueId}" ;?>'>
            <br>

            <div class="form-group">
                <label for="leagueName">League Name</label>
                <br>
                <input name="leagueName" id="leagueName" type="text">
            </div>

            <div class="form-group">
                <label for="leagueRules">League Rules</label>
                <br>
                <input name="leagueRules" id="leagueRules" type="text">
            </div>

            <div class="form-group">
                <label for="matchRules">Match Rules</label>
                <br>
                <input name="matchRules" id="matchRules" type="text">
            </div>

            <div class="form-group">
                <label for="isIndoor">Is Indoor</label>
                <br>
                <select name="isIndoor" id="isIndoor">
                    <option value="1">Indoor</option>
                    <option value="0">Outdoor</option>
                </select>
            </div>

            <div class="form-group">
                <label for="minTeams">Minimum Number of Teams</label>
                <br>
                <input name="minTeams" id="minTeams" type="text">
            </div>

            <div class="form-group">
                <label for="maxTeams">Maximum Number of Teams</label>
                <br>
                <input name="maxTeams" id="maxTeams" type="text">
            </div>

            <div class="form-group">
                <label for="minMembers">Minimum Number of Members</label>
                <br>
                <input name="minMembers" id="minMembers" type="text">
            </div>

            <div class="form-group">
                <label for="maxMembers">Maximum Number of Members</label>
                <br>
                <input name="maxMembers" id="maxMembers" type="text">
            </div>

            <div class="form-group">
                <label for="winner">Winner of League</label>
                <br>
                <input name="winner" id="winner" type="text">
            </div>
<input type="submit" value="submit">
        </form>
    </div>
</body>

<?php include('includes/footer.php'); ?>
