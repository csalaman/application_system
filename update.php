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
    <br><div class="container" name="logoUMD" >

                <div  style="float: left; align-content: left; display: inline-block">
                    <img src="umdLogo.gif" alt="University Of Maryland">
                </div>
               
    </div><br>
    
    <div class="container border">
            <form action="{$_SERVER['PHP_SELF']}" method="POST">
                <div class="form-group">
                
                <label for="email"><strong>Email associated with application:</strong></label>
                <input type="email" name="user_up" required><br>
                
                <label for="password"><strong>Password associated with application:</strong></label>
                <input type="password" name="password_up" required><br>
                
                <input type="submit" value="Submit" name="update_log"><br>
                </div>
            </form>
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


if (isset($_POST['update_verification'])) {

    if (trim($_POST['password1']) != trim($_POST['password2'])) {
        echo "<div class='container'><p><strong>Passwords do not match!</p></div>";
        $entry = $db->getUserByEmail($_SESSION['user']);

        $html_up = "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Projecto 4</title>
    <link href=\"bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
    <br><div class=\"container\" name=\"logoUMD\" >

                <div  style=\"float: left; align-content: left; display: inline-block\">
                    <img src=\"umdLogo.gif\" alt=\"University Of Maryland\">
                </div>
               
    </div><br>
    
    <div class=\"container border\">
            <form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\">
                <div class=\"form-group\">
                
                <label for=\"name\"><strong>Name:</strong></label>
                <input type=\"text\" name=\"name\" value='{$entry['name']}' required><br>
                
                <label for=\"email\"><strong>Email:</strong></label>
                <input type=\"email\" name=\"email\" value='{$entry['email']}' required><br>
                
                <label for=\"gpa\"><strong>GPA:</strong></label>
                <input type=\"text\" name=\"gpa\" value='{$entry['gpa']}'required><br>
";
        if ($entry['year'] == 10) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\" checked required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\">
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else if ($entry['year'] == 11) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" checked>
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" >
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\" checked>
                <label for=\"radio\">12</label>
                </div>
            ";
        }

        if ($entry['gender'] == 'M') {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\" checked required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\">
                <label for=\"radio\">F</label>
               </div>
            ";
        } else {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\"  required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\" checked>
                <label for=\"radio\">F</label>
               </div>
            ";
        }

        $html_up .= "
        <label for=\"password\"><strong>Password:</strong></label>
                <input type=\"password\" name=\"password1\" value='${_SESSION['password']}' required><br>

                <label for=\"veri\"><strong>Verify Password:</strong></label>
                <input type=\"password\" name=\"password2\" value='${_SESSION['password']}' required><br>


                <input type=\"submit\" value=\"Submit Data\" name=\"update_verification\"><br>


                </div>
            </form><br>
            <form action=\"main.html\">
                <input type=\"submit\" value=\"Return to main menu\" />
            </form>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src=\"bootstrap/jquery-3.2.1.min.js\"></script>
<script src=\"bootstrap/js/bootstrap.min.js\"></script>
</body>
</html>
        ";
        echo $html_up;

    } else {
        $new_name = trim($_POST['name']);
        $new_email = trim($_POST['email']);
        $new_gpa = trim($_POST['gpa']);
        $new_year = $_POST['year'];
        $new_gender = $_POST['gender'];
        $new_password = trim($_POST['password1']);
        if ($db->update($new_name, $_SESSION['user'], $new_email, $new_gpa, $new_year, $new_gender, $_SESSION['password'], $new_password)) {
            $_SESSION['user'] = $new_email;
            $_SESSION['password'] = $new_password;

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
  <br>
  <div class="container" name="logoUMD" >
    <div  style="float: left; align-content: left; display: inline-block">
       <img src="umdLogo.gif" alt="University Of Maryland">
    </div>
               
  </div><br>

  <div class="container border">
            
    <p><strong>The following entry has been added to the database</strong></p>
    <p><strong>Name: </strong> {$new_name}</p>
    <p><strong>Email: </strong> {$new_email}</p>
    <p><strong>Gpa: </strong>{$new_gpa}</p>
    <p><strong>Year: </strong>{$new_year}</p>
    <p><strong>Gender: </strong>{$new_gender}</p>
    <form action="main.html">
       <input type="submit" value="Return to main menu" />
     </form>
   </div>
</body>
</html>
HTML;
            echo $out;


        } else {
            echo "<p>ERROR SUBMITTING TO DATABASE!</p>";
        }
    }
} else if ((isset($_SESSION['user']) && isset($_SESSION['password']))) {
    if ($db->verifyPassword($_SESSION['user'], $_SESSION['password'])) {
        $entry = $db->getUserByEmail($_SESSION['user']);

        $html_up = "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Projecto 4</title>
    <link href=\"bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
    <br>
    <div class=\"container\" name=\"logoUMD\" >
       <div  style=\"float: left; align-content: left; display: inline-block\">
        <img src=\"umdLogo.gif\" alt=\"University Of Maryland\">
       </div>               
    </div>
    <br>

    <div class=\"container border\">
            <form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\">
                <div class=\"form-group\">
                
                <label for=\"name\"><strong>Name:</strong></label>
                <input type=\"text\" name=\"name\" value='{$entry['name']}' required><br>
                
                <label for=\"email\"><strong>Email:</strong></label>
                <input type=\"email\" name=\"email\" value='{$entry['email']}' required><br>
                
                <label for=\"gpa\"><strong>GPA:</strong></label>
                <input type=\"text\" name=\"gpa\" value='{$entry['gpa']}'required><br>
";
        if ($entry['year'] == 10) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\" checked required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\">
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else if ($entry['year'] == 11) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" checked>
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" >
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\" checked>
                <label for=\"radio\">12</label>
                </div>
            ";
        }

        if ($entry['gender'] == 'M') {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\" checked required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\">
                <label for=\"radio\">F</label>
               </div>
            ";
        } else {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\"  required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\" checked>
                <label for=\"radio\">F</label>
               </div>
            ";
        }

        $html_up .= "
        <label for=\"password\"><strong>Password:</strong></label>
                <input type=\"password\" name=\"password1\" value='${_SESSION['password']}' required><br>

                <label for=\"veri\"><strong>Verify Password:</strong></label>
                <input type=\"password\" name=\"password2\" value='${_SESSION['password']}' required><br>


                <input type=\"submit\" value=\"Submit Data\" name=\"update_verification\"><br>


                </div>
            </form><br>
            <form action=\"main.html\">
                <input type=\"submit\" value=\"Return to main menu\" />
            </form>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src=\"bootstrap/jquery-3.2.1.min.js\"></script>
<script src=\"bootstrap/js/bootstrap.min.js\"></script>
</body>
</html>
        ";
        echo $html_up;
    } else {
        echo "<div class='container'><p><strong>Invalid username/password</strong></p></div>";
        unset($_SESSION['user']);
        unset($_SESSION['password']);
        echo $html_one;
    }
} else if (isset($_POST['update_log'])) {
    if ($db->verifyPassword(trim($_POST['user_up']), trim($_POST['password_up']))) {
        $entry = $db->getUserByEmail(trim($_POST['user_up']));
        $_SESSION['user'] = trim($_POST['user_up']);
        $_SESSION['password'] = trim($_POST['password_up']);

        $html_up = "

<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>Projecto 4</title>
    <link href=\"bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">
    <style>
    .border{border-style: outset;}
    </style>
</head>
<body>
    <div class=\"container border\">
            <form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\">
                <div class=\"form-group\">
                
                <label for=\"name\"><strong>Name:</strong></label>
                <input type=\"text\" name=\"name\" value='{$entry['name']}' required><br>
                
                <label for=\"email\"><strong>Email:</strong></label>
                <input type=\"email\" name=\"email\" value='{$entry['email']}' required><br>
                
                <label for=\"gpa\"><strong>GPA:</strong></label>
                <input type=\"text\" name=\"gpa\" value='{$entry['gpa']}'required><br>
";
        if ($entry['year'] == 10) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\" checked required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\">
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else if ($entry['year'] == 11) {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" checked>
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\">
                <label for=\"radio\">12</label>
                </div>
            ";
        } else {
            $html_up .= "
             <div class=\"form-group\" >
                <label for=\"year\"><strong>Year:</strong></label>
               
                <input type=\"radio\" value = \"10\" name=\"year\"  required>
                <label for=\"radio\">10</label>

                <input type=\"radio\" value=\"11\"  name=\"year\" >
                <label for=\"radio\">11</label>

                <input type=\"radio\"  value =\"12\" name=\"year\" checked>
                <label for=\"radio\">12</label>
                </div>
            ";
        }

        if ($entry['gender'] == 'M') {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\" checked required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\">
                <label for=\"radio\">F</label>
               </div>
            ";
        } else {
            $html_up .= "
            <div class=\"form-group\" >
                <label for=\"gender\"><strong>Gender:</strong></label>
                
                <input type=\"radio\" value=\"M\"  name=\"gender\"  required>
                <label for=\"radio\">M</label>

                <input type=\"radio\"  value =\"F\" name=\"gender\" checked>
                <label for=\"radio\">F</label>
               </div>
            ";
        }

        $html_up .= "
        <label for=\"password\"><strong>Password:</strong></label>
                <input type=\"password\" name=\"password1\" value='${_SESSION['password']}' required><br>

                <label for=\"veri\"><strong>Verify Password:</strong></label>
                <input type=\"password\" name=\"password2\" value='${_SESSION['password']}' required><br>


                <input type=\"submit\" value=\"Submit Data\" name=\"update_verification\"><br>


                </div>
            </form><br>
            <form action=\"main.html\">
                <input type=\"submit\" value=\"Return to main menu\" />
            </form>
        </div>

    </div>



<!-- jQuery (needed for Bootstrap's JS plugins) -->
<script src=\"bootstrap/jquery-3.2.1.min.js\"></script>
<script src=\"bootstrap/js/bootstrap.min.js\"></script>
</body>
</html>
        ";
        echo $html_up;
    } else {
        echo "<div class='container'><p><strong>Invalid username/password</strong></p></div>";
        unset($_SESSION['user']);
        unset($_SESSION['password']);
        echo $html_one;
    }

} else {
    echo $html_one;
}


?>