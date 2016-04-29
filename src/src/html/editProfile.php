<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 4/25/16
 * Time: 15:48
 */
include("includes/header.php");
?>

<body>
<div class="container">
    <h1>Update profile for <?php echo "{$_SESSION['firstName']} {$_SESSION['lastName']}";?></h1>
    <br/>
    <p>
        Edit your profile.<br/>
        <strong>Only add values to the fields in which you wish to update.</strong>

    </p>

    <form id="updateUser" action="php/doUpdateUser.php" method="post">
        <table>
            <tr>
                <td>
                    <div class="form-group">
                        <label for="firstName">First Name</label>
                        <br>
                        <input name="firstName" id="firstName" type="text" placeholder="Jon" pattern="[A-z]{1,}" title="first name" style="border-radius:5px;padding:12px;width:200px;height:10px">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="lastName">Last Name</label>
                        <br>
                        <input name="lastName" id="lastName" type="text" placeholder="Snow" pattern="[A-z]{1,}" title="last name" style="border-radius:5px;padding:12px;width:200px;height:10px">
                    </div>
                </td>

            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <br>
                        <input name="password" id="password" type="password" pattern="[A-z0-9]{6,}" placeholder="••••••" title="6 character minimum" style="border-radius:5px;padding:12px;width:200px;height:10px">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <label for="passwordVerify">Verify Password</label>
                        <br>
                        <input name="passwordVerify" id="passwordVerify" type="password" placeholder="••••••" style="border-radius:5px;padding:12px;width:200px;height:10px">
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            <label for="email">Email</label>
            <br>
            <input name="email" id="email" type="email" placeholder="player@example.com" title="Student email" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>
        <div class="form-group">
            <label for="studentNumber">Student Number</label>
            <br>
            <input name="studentNumber" id="studentNumber" type="text" title="Student Number" placeholder="810XXXXXX" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <br>
            <input name="address" id="address" type="text" title="Your local Address" placeholder="100 Maple St" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>
        <div class="form-group">
            <label for="major">Major</label>
            <br>
            <input name="major" id="major" placeholder="Computer Science" style="border-radius:5px;padding:12px;width:200px;height:10px">
        </div>
        <div class="form-group">
            <input style="form-control" type="submit" name="Submit">
        </div>
    </form>

</div>
</body>

<?php include('includes/footer.php'); ?>