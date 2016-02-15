<?php
include('../resources/templates/main/includes/header.php');
include('php/Functions.php');
?>
<body>
<div class="container">
    <h1>Registration Form</h1>
 <?php echo Functions::displayRegisterForm();?>
</div>
</body>

<?php include('../resources/templates/main/includes/footer.php');