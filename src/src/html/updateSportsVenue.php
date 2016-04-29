<?php 
include('includes/header.php');
$sportsVenueId = $_POST['sportsVenueId'];
?>

<body>
<div class="container">
    <h3>Update Venue</h3>
    <br>

    <p>
    <form id="updateSportsVenue" action="php/doUpdateSportsVenue.php" method="post">
        <input type = 'hidden' name = 'sportsVenueId' value = '<?php echo strval($sportsVenueId);?>'>

        <div class="form-group">
            <label for="venueName">Venue Name</label>
            <br>
            <input name="venueName" id="venueName" type="text">
        </div>

        <div class="form-group">
            <label for="venueType">Indoor or Outdoor?</label>
            <br>
            <select name="isIndoor" id="isIndoor"> 
                <option value="-1">---SELECT OPTION--</option>
                <option value="1">Indoor</option>
                <option value="0">Outdoor</option>
            </select>
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <br>
            <input name="address" id="address" type="text"  title="address">
        </div>

        <p>
            <input type="submit" value = "Update Sports Venue"> 
        </p>

    </form>
    </p>

</div>
</body>

<?php include('includes/footer.php'); ?>