<?php include('includes/header.php')?>

<body>
    <h1>Create Sports Venue</h1>
    
    
    <form method="POST" action="php/createSportsVenue">
        Create your own Team:
        <br><br>
        
        <label for="venueName">Venue Name</label>
        <br>
        <input name="venueName" id="venueName" type="text" placeholder="Diagon Alley" required="true" pattern="[A-z]{1,}" title="venue name" style="border-radius:5px;padding:12px;width:200px;height:10px">
        
        
        <br><br>    
        
        
         <label for="venueType">Is this an indoor or outdoor venue?</label>
        <br>
        <select name="isIndoor" id="isIndoor"> 
            <option value="indoor">Indoor</option>
            <option value="outdoor">Outdoor</option>
        
        </select>
        
        
        <br><br>    
        
        <label for="address">Address</label>
        <br>
        <input name="address" id="address" type="text"  required="true" pattern="[A-z]{1,}" title="address" style="border-radius:5px;padding:12px;width:200px;height:10px">
        
        
        <br><br>    
        <p>
            <input type="submit" value = "Create Sports Venue"> 
        </p>
    </form>
   </p>

</body>