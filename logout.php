<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/23/2018
 * Time: 8:19 PM
 */

session_start();

unset($_SESSION['user']);
unset($_SESSION['password']);

unset($_SERVER['PHP_AUTH_USER']);
unset($_SERVER['PHP_AUTH_PW']);

unset($_POST['admin_app']);

$logout_alert = <<<LOG
    <script>
        if(confirm("You have succesfully logout!")){
            window.location.replace("main.html")
        }else{
            window.location.replace("main.html")
        }
    </script>
LOG;

echo $logout_alert;

?>