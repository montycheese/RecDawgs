<?php include('includes/header.php')?>

<body>
    <h1>(Leagues Name)</h1>
    
     <form method="POST" action="php/joinTeam.php"> 
             
         <p>
             List of current teams:
        </p>
            
            
            <input type="submit" value = "Join Team"> 
        </form>
    
    <br> <br> <br>
    
    <form method="POST" action="php/createTeam.php">
        Create your own Team:
        <br><br>
        
        <label for="teamName">Team Name</label>
        <br>
        <input name="teamName" id="teamName" type="text" placeholder="Team Name" required="true" pattern="[A-z]{1,}" title="team name" style="border-radius:5px;padding:12px;width:200px;height:10px">
        
        
        <br><br>    
        <p>
            <input type="submit" value = "Create Team"> 
        </p>
    </form>
   

</body>