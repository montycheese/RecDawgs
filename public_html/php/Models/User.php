<?php
/**
 * Created by PhpStorm.
 * User: montanawong
 * Date: 2/15/16
 * Time: 14:09
 */

require_once '../../resources/config.php';

class User {
    private $id;
    private $firstName;
    private $lastName;
    private $major;
    private $address;
    private $email;
    private $passwordHash;
    private $studentNumber;

    public function __construct($firstName, $lastName, $email, $studentNumber, $passwordHash, $address, $major){
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->major = $major;
        $this->address = $address;
        $this->email = $email;
        $this->passwordHash = $passwordHash;
        $this->studentNumber = $studentNumber;
    }

    /**
     * @return bool true if database insertion worked, false otherwise
     */
    public function register(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Check connection
        if ($conn->connect_error) {
            return false;
        }
        $sql = "INSERT INTO user (first_name, last_name, password_hash, email, student_number, address, major)
VALUES ('{$this->$firstName}', '{$this->$lastName}', '{$this->$passwordHash}', '{$this->$email}', '{$this->$studentNumber}', '{$this->$address}', '{$this->$major}');";

        if ($conn->query($sql) === TRUE) {
            //echo "New record created successfully";
            //Functions::redirect('../index.php?status=registersuccess');
            $conn->close();
            return True;
        } else {
            $conn->close();
            return False;
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }






    }

    public static function getInfo($user_id){
        //return associative array from db.
    }

}