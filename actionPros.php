<?php
/**
 * Created by PhpStorm.
 * User: csalaman
 * Date: 3/22/2018
 * Time: 7:12 PM
 */

require_once "DatabaseInstance.php";

#$db->insert('juana','y@tho.com',3.99,2,'M','hi');
//$db->update('juana','y@tho.com','cause@you.com',20.5,100,'F','hi','byebye');
//$db->getData();

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
    header('Location: admin.php');
}

?>


