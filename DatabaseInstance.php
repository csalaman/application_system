<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 7:15 PM
 */

require_once "dbLoginInfo.php";

class DatabaseInstance
{

    private $db_connect;

    function __construct($host, $user, $password, $database)
    {
        $this->db_connect = new mysqli($host,$user,$password,$database);
        if($this->db_connect->connect_error){
            die($this->db_connect->connect_error);
        }
    }

    // Insertion, return 1 if success
    function insert($name,$email,$gpa,$year,$gender,$password){
        $hash_pass = password_hash($password,PASSWORD_DEFAULT);

        $query = "INSERT INTO applicants VALUES ('{$name}','{$email}',$gpa,$year,'{$gender}','{$hash_pass}')";
        $result = $this->db_connect->query($query);

        if(!$result){
            die("Insertion failed: ".$this->db_connect->error);
        }else{
            return True;
        }
    }

    // Updates an entry
    function update($name,$curr_email,$update_email,$gpa,$year,$gender,$curr_password,$update_password){
        if($this->verifyPassword($curr_email,$curr_password)){
            $hash_pass = password_hash($update_password,PASSWORD_DEFAULT);
            $query = "UPDATE applicants set name = '{$name}', email = '{$update_email}',gpa=$gpa,year=$year,gender = '{$gender}',password='{$hash_pass}' WHERE email='{$curr_email}'";
            $result = $this->db_connect->query($query);
            if(!$result){
                die("Update failed: ".$this->db_connect->error);
            }else{

                return True;
            }
        }else{
            echo "NO MATCHAAAAAAAAAA";
            return False;
        }

    }
    // Get everything
    function getData(){
        $query = "select * from applicants";
        $result = $this->db_connect->query($query);
        if(!$result){
            die("Data Retrieve failed: ".$this->db_connect->error);
        }else{
            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                   echo $row['name'].",".$row['email'].",".$row['gpa'].",".$row['year'].",".$row['gender'].",".$row['password'];
                   echo "<br>";
                }
            }
        }
    }
    // Verifies if the password is associated with email
    function verifyPassword($email,$password){
        $query = "SELECT password FROM applicants WHERE email = '{$email}'";
        $result = $this->db_connect->query($query);
        if(!$result){
            echo "<div class='container'><p><strong>Could not locate user to compare password!</strong></p> </div>";
            return False;
        }else{
            $row = mysqli_fetch_row($result);
            if(password_verify($password,$row[0])){
                return True;
            }else{
                return False;
            }
        }
    }

    function getUserByEmail($email){
        $query = "SELECT * FROM applicants WHERE email = '{$email}'";
        $result = $this->db_connect->query($query);
        if(!$result){
            echo "<div class='container'><p><strong>Could not locate user to retrieve!</strong></p> </div>";
        }else{
            return $result->fetch_assoc();
        }
    }

}

$db = new DatabaseInstance($host,$user,$password,$database);


?>