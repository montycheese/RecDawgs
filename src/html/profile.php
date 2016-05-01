<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/25/16
 * Time: 15:01
*/
include("includes/header.php");
spl_autoload_register(function ($class_name) {
    include '/Users/montanawong/Sites/RecDawgs/src/' . str_replace('\\', '/', $class_name) .'.php';
});

use edu\uga\cs\recdawgs\presentation as Presentation;
?>


<body>
<div class="container">
    <h1><?php echo "{$_SESSION['firstName']} {$_SESSION['lastName']}'s";?> Profile page </h1>
    <br/>
    <p>
        Welcome to your profile page.

    </p>

    <h2>Information</h2>
    <p>
        <?php
        $userUI = new Presentation\UserUI();
        echo $userUI->listUserInformation($_SESSION['userId'], $_SESSION['userType']);
        ?>
    </p>

    <button onclick="editProfile()">Edit your information</button>
    <br/><br/>
    <h3> Delete your account</h3>
    <form action="php/doDeleteUser.php" method="post">
        <input type="hidden" name="userId" value="<?php echo $_SESSION['userId'];?>">
    <input type="submit" value="Delete your account">
    </form>

</div>
</body>
<script>
    function editProfile(){
        window.location.href = "./editProfile.php"
    }

</script>


<?php include('includes/footer.php'); ?>