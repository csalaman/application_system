<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 7:12 PM
 */

require_once "DatabaseInstance.php";

$user = "main";
$pass_hash = password_hash("terps",PASSWORD_DEFAULT);

if(isset($_POST['submit_app'])){
    unset($_POST['submit_app']);
    header('Location: submit.php');
}else if(isset($_POST['review_app'])){
    unset($_POST['review_app']);
    header('Location: review.php');
}else if(isset($_POST['update_app'])){
    unset($_POST['update_app']);
    header('Location: update.php');
}else if(isset($_POST['admin_app'])){
    unset($_POST['admin_app']);
    if(isset($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) &&
        $_SERVER['PHP_AUTH_USER'] == $user && password_verify($_SERVER['PHP_AUTH_PW'],$pass_hash)){
        header('Location: admin.php');
    }else {
        header("WWW-Authenticate: Basic realm=\"Hi you here\"");
        header("HTTP/1.0 401 Unauthorized");
        echo "You have cancelled admin login";
    }
}

?>


