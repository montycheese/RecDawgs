<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 2/13/16
 * Time: 11:53
 */

class Functions
{
    public static function displayRegisterForm($user_type = 'user')
    {
        $output = '';
        switch ($user_type) {
            case 'user':
                $output .= '<form id="register" action="php/insert_user.php" method="post">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input name="first_name" id="first_name" type="text" placeholder="First" required="true" pattern="[A-z]{1,}" title="first name">
                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" id="last_name" type="text" placeholder="Last" required="true" pattern="[A-z]{1,}" title="last name">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name="password" id="password" type="password" required="true" pattern="[A-z0-9]{6,}" title="6 character minimum" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="password_verify">Verify Password</label>
                                    <input name="password_verify" id="password_verify" type="password" required="true" id="password_verify">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" type="email" placeholder="player@example.com" required="true" title="Student email">
                                </div>
                                <div class="form-group">
                                    <label for="student_number">Student Number</label>
                                    <input name="student_number" id="student_number" type="text" required="true" title="Student Number">
                                </div>
                                <div class="form-group">
                                    <label for="address">Address</label>
                                    <input name="address" id="address" type="text" required="true" title="Your local Address">
                                </div>
                                <div class="form-group">
                                    <label for="major">Major</label>
                                    <select name="major" id="major">
                                      <option value="cs">Computer Science</option>
                                      <option value="mis">MIS</option>
                                      <option value="business">Business</option>
                                      <option value="art">Art</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                <input style="form-control" type="submit" name="Submit">
                                </div>
                            </form>';
                break;
            case 'admin':
                # TODO
                break;

        }
        return $output;
    }

    public static function getUserInfo($user_id)
    {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
        $sql = "SELECT * FROM user WHERE user_id = ?";

        $pdoStatement = $pdo->prepare($sql);
        $pdoStatement->bindParam(1, $user_id, PDO::PARAM_STR);
        $user_info = "";
        if ($pdoStatement->execute()) {
            $user_info = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        }
        //TODO add else condition
        return $user_info;
    }


    public static function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
        die();
    }
}
?>