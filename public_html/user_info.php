<?php
include('../resources/templates/main/includes/header.php');
require_once('php/Functions.php');

//temp logic, use sessions later to hold user id data
$_SESSION['user_id'] = (isset($_GET['id'])) ? $_GET['id'] : 1;
$user_info = Functions::getUserInfo($_SESSION['user_id']);
?>

<body>
<h1>User Info for user id: <?php echo $user_info['user_id'] ?></h1>
<div class="container">
<h2>Hello! <?php echo $user_info['first_name'] . ' ' . $user_info['last_name'] ;?></h2>
    <h3>Your email is: <?php echo $user_info['email']; ?></h3>
    <h3>Your Major is: <?php echo $user_info['major']; ?></h3>
    <h3>You live at: <?php echo $user_info['address']; ?></h3>
</div
</body>

<?php include('../resources/templates/main/includes/footer.php');