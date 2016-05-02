 <?php include('includes/header.php');?>

<body>
<div class="container">
    <h1>Reset Password</h1>
    
    <form id="login" action="php/doResetPassword.php" method="post">
        <div class="form-group">
            <label for="userName">User Name</label>
            <br>
            <input name="userName" id="userName" type="userName" placeholder="player123" required="true" title="username">
        </div>
        <div class="form-group">
            <input style="form-control" type="submit" name="Reset" value="Reset">
        </div>
    </form>
    
    
</div>
</body>

<?php include('includes/footer.php'); ?>