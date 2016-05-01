<?php include('includes/header.php'); ?>

<body>

    <div class="container">
    <h1>Create Sports Venue</h1>
    
    
    <form method="POST" action="php/doCreateSportsVenue.php">

        <div class="form-group">
            <label for="venueName">Venue Name</label>
            <br>
            <input name="venueName" id="venueName" type="text" placeholder="Diagon Alley" required>
        </div>

        <div class="form-group">
            <label for="venueType">Indoor or Outdoor?</label>
            <br>
            <select name="isIndoor" id="isIndoor"> 
                <option value="-1">---SELECT TEAM TO VIEW---</option>
                <option value="1">Indoor</option>
                <option value="0">Outdoor</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <br>
            <input name="address" id="address" type="text"  title="address" required>
        </div>

        <p>
            <input type="submit" value = "Create Sports Venue"> 
        </p>
    </form>
    </div>

</body>

<?php include('includes/footer.php'); ?>