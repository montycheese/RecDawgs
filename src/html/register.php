<?php include('includes/header.php'); ?>

<body>
<div class="container">
    <h3>Register</h3>
    <br>
    <form id="register" action="php/doCreateUser.php" method="post">
        <table>
            <tr>
                <td>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <br>
                        <input name="firstName" id="firstName" type="text" placeholder="Jon" required="true" pattern="[A-z]{1,}" title="first name">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <br>
                        <input name="lastName" id="lastName" type="text" placeholder="Snow" required="true" pattern="[A-z]{1,}" title="last name">
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <br>
                        <input name="password" id="password" type="password" required="true" pattern="[A-z0-9]{6,}" placeholder="••••••" title="6 character minimum">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="passwordVerify">Verify Password</label>
                        <br>
                        <input name="passwordVerify" id="passwordVerify" type="password" required="true" placeholder="••••••">
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="userName">User Name</label>
            <br>
            <input name="userName" id="userName" type="text" placeholder="player123" required="true" title="Student username">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <br>
            <input name="email" id="email" type="email" placeholder="player@example.com" required="true" title="Student email">
        </div>
        <div class="form-group">
            <label for="studentNumber">Student Number</label>
            <br>
            <input name="studentNumber" id="studentNumber" type="text" required="true" title="Student Number" placeholder="810XXXXXX">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <br>
            <input name="address" id="address" type="text" required="true" title="Your local Address" placeholder="100 Maple St">
        </div>
        <div class="form-group">
            <label for="major">Major</label>
            <br>
            <input name="major" id="major" required="true" placeholder="Computer Science">
        </div>
        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>
    </form>

</div>
</body>

<?php include('includes/footer.php'); ?>