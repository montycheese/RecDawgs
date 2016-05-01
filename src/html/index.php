<?php include('includes/header.php');?>

<body>
<div class="container">
    <h1>Rec Dawgs Homepage</h1>
    
   
    <p>
        <form method="POST" action="leagues.php"> 
             
            
            
            
            <input type="image" src = "img/leagueButton.png" value="showLeagues" alt = "Submit"> 
        </form>
        
    </p>
    <?php
      if ($_SESSION['userType'] == 0)
      {
          echo "<p>
        <form method='POST' action='teams.php'>
            <input type='image' src = 'img/teamButton.png' value='showTeams' alt = 'Submit'> 
        </form>
        
    </p>";

      }
    if ($_SESSION['userType'] == 1)
    {
        echo "<p>
        <form method='POST' action='sportsVenues.php'>
            <input type='image' src = 'img/viewVenuesButton.png' value='showVenues' alt = 'Submit'>
        </form>

    </p>";

    }

    ?>
    
</div>
</body>

<?php include('includes/footer.php'); ?>