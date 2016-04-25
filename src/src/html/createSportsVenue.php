<?php include('includes/header.php'); ?>

<body>

    <div class="container">
    <h1>Create Sports Venue</h1>
    
    
    <form method="POST" action="php/doCreateSportsVenue.php">

        <div class="form-group">
            <label for="venueName">Venue Name</label>
            <br>
            <input name="venueName" id="venueName" type="text" placeholder="Diagon Alley" pattern="[A-z]{1,}" required>
        </div>

        <div class="form-group">
            <label for="venueType">Indoor or Outdoor?</label>
            <br>
            <select name="isIndoor" id="isIndoor"> 
                <option value="true">Indoor</option>
                <option value="false">Outdoor</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="address">Address</label>
            <br>
            <input name="address" id="address" type="text"  pattern="[A-z]{1,}" title="address" required>
        </div>

        <p>
            <input type="submit" value = "Create Sports Venue"> 
        </p>
    </form>
    </div>

</body>

<?php include('includes/footer.php'); ?>