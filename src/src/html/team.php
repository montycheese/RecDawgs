<?php 
include('includes/header.php');
$theTeamID = $_POST['teams'];
?>

<body>
    <h1>(Team Name)</h1>
    
    <h3>Team Members</h3>

    <h3>Update Team Information</h3>


    <form method="POST" action="php/updateTeam.php">
        <input name="teamID" id="teamID" type="hidden" value="<?php echo $theTeamID ?>">
        <p>
            <input type="submit" value = "Create Team"> 
        </p>
    </form>
   </p>

</body>
</html>