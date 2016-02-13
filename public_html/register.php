<?php
include('../resources/templates/main/includes/header.php');
include('php/Functions.php');
include('../resources/config.php');
?>
<body>
<h1>Registration Form</h1>
<div class="container">
 <?php echo Functions::displayRegisterForm();?>
</div>
</body>

<?php include('../resources/templates/main/includes/footer.php');