<?php include('includes/header.php');?>

<body>
<div class="container">
    <h1>Log-in</h1>
    
   
    <form id="login" action="#" method="post">
        <div class="form-group">
            <label for="email">Email Address</label>
            <br>
            <input name="email" id="email" type="email" placeholder="player@example.com" required="true" title="Student email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <br>
            <input name="password" id="password" type="password" required="true" pattern="[A-z0-9]{6,}" placeholder="••••••" title="6 character minimum">
        </div>
        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>
    </form>

    <p><a href="#">Forget Your Password?</a></p>
    
    
</div>
</body>
</html>