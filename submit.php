<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 9:34 PM
 */

require_once "DatabaseInstance.php";
session_start();

$html_in = <<< HTML
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Projecto 4</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
    <div class="container border">
            <form action="{$_SERVER['PHP_SELF']}" method="POST">
                <div class="form-group">
                
                <label for="name"><strong>Name:</strong></label>
                <input type="text" name="name" required><br>
                
                <label for="email"><strong>Email:</strong></label>
                <input type="email" name="email" required><br>
                
                <label for="gpa"><strong>GPA:</strong></label>
                <input type="text" name="gpa" required><br>
                
                
                <div class="form-group" >
                <label for="year"><strong>Year:</strong></label>
               
                <input type="radio" value = "10" name="year" required>
                <label for="radio">10</label>

                <input type="radio" value="11"  name="year">
                <label for="radio">11</label>

                <input type="radio"  value ="12" name="year">
                <label for="radio">12</label>
                </div>
                
                <div class="form-group" >
                <label for="gender"><strong>Gender:</strong></label>
                
                <input type="radio" value="M"  name="gender" required>
                <label for="radio">M</label>

                <input type="radio"  value ="F" name="gender">
                <label for="radio">F</label>
                </div>
                
                <label for="password"><strong>Password:</strong></label>
                <input type="password" name="password1" required><br>
                
                <label for="veri"><strong>Verify Password:</strong></label>
                <input type="password" name="password2" required><br>
                
                
                <input type="submit" value="Submit Data" name="submit_data"><br>
                

                </div>
            </form><br>
            <form action="main.html">
                <input type="submit" value="Return to main menu" />
            </form>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src="bootstrap/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
HTML;




if(!isset($_POST['submit_data']) && !isset($_POST['main_return'])){
    echo $html_in;
}else if(isset($_POST['main_return'])){
    unset($_POST['main_return']);
    header('Location: main.html');
}else if(isset($_POST['submit_data'])){
    if(trim($_POST['password1']) != trim($_POST['password2'])){
        echo $html_in;
        echo "<div class='container'><p><strong>Passwords do not match!</p></div>";
    }else{
        if($db->insert(trim($_POST['name']),trim($_POST['email']),floatval(trim($_POST['gpa'])),trim($_POST['year']),trim($_POST['gender']),trim($_POST['password1']))){
            $name = trim($_POST['name']);
            $email=trim($_POST['email']);
            $gpa=floatval(trim($_POST['gpa']));

            $_SESSION['user'] = $email;
            $_SESSION['password'] = trim($_POST['password1']);


            $out = <<<HTML
                <!DOCTYPE html>
                <html lang="en" >
                <head>
                    <meta charset="UTF-8">
                  <meta http-equiv="X-UA-Compatible" content="IE=edge">
                 <meta name="viewport" content="width=device-width, initial-scale=1">
                 <title>Projecto 4</title>
                 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
                 <style>
                    .border{border-style: outset;}
                 </style>
                </head>
                <body>
                  <div class="container border">
            
                            <p><strong>The following entry has been added to the database</strong></p>
                            <p><strong>Name: </strong> {$name}</p>
                            <p><strong>Email: </strong> {$email}</p>
                            <p><strong>Gpa: </strong>{$gpa}</p>
                            <p><strong>Year: </strong>{$_POST['year']}</p>
                            <p><strong>Gender: </strong>{$_POST['gender']}</p>
                          <form action="main.html">
                               <input type="submit" value="Return to main menu" />
                           </form>
                 </div>
                </body>
                </html>
HTML;
        echo $out;
        }else{
            echo "<p>ERROR SUBMITTING TO DATABASE!</p>";
        }
    }


}else if(isset($_POST['main_return'])){
    unset($_POST['main_return']);
    header('Location: main.html');
}

?>