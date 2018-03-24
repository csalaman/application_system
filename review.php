<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 9:36 PM
 */
require_once "DatabaseInstance.php";
session_start();
$html_one = <<<HTML
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
                
                <label for="email"><strong>Email associated with application:</strong></label>
                <input type="email" name="email_rev" required><br>
                
                <label for="password"><strong>Password associated with application:</strong></label>
                <input type="password" name="password_rev" required><br>
                
                <input type="submit" value="Submit" name="review_submit"><br>
                </div>
            </form>
            <form action="main.html">
                <input type="submit" value="Return to main menu" />
            </form><br>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src="bootstrap/jquery-3.2.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
HTML;





if(isset($_SESSION['user']) && isset($_SESSION['password']) ){
    if($db->verifyPassword($_SESSION['user'],$_SESSION['password'])){
        $entry = $db->getUserByEmail($_SESSION['user']);
        if($entry){
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
            
                            <p><strong>Application found in the database with the following values:</strong></p>
                            <p><strong>Name: </strong> {$entry['name']}</p>
                            <p><strong>Email: </strong> {$entry['email']}</p>
                            <p><strong>Gpa: </strong>{$entry['gpa']}</p>
                            <p><strong>Year: </strong>{$entry['year']}</p>
                            <p><strong>Gender: </strong>{$entry['gender']}</p>
                          <form action="main.html">
                               <input type="submit" value="Return to main menu" />
                           </form><br>
                 </div>
                </body>
                </html>
HTML;
            echo $out;
        }
    }

}
else if(!isset($_POST['review_submit'])){
    echo $html_one;
}else{

    if($db->verifyPassword(trim($_POST['email_rev']),trim($_POST['password_rev']))){
        $_SESSION['user'] = trim($_POST['email_rev']);
        $_SESSION['password'] = trim($_POST['password_rev']);

        $entry = $db->getUserByEmail(trim($_POST['email_rev']));
        if($entry){
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
                            <p><strong>Name: </strong> {$entry['name']}</p>
                            <p><strong>Email: </strong> {$entry['email']}</p>
                            <p><strong>Gpa: </strong>{$entry['gpa']}</p>
                            <p><strong>Year: </strong>{$entry['year']}</p>
                            <p><strong>Gender: </strong>{$entry['gender']}</p>
                          <form action="main.html">
                               <input type="submit" value="Return to main menu" />
                           </form><br>
                 </div>
                </body>
                </html>
HTML;
            echo $out;
        }
    }else{
        echo "<div class='container'><p><strong>Invalid username/password</strong></p></div>";
        echo $html_one;
    }
}


?>