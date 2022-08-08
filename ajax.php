<?php
session_start();
include('./config/dbconn.php');
$id = $_SESSION['auth_user']['user_id'];
if(isset($_POST['username'])){
   $user = $_POST['username'];
   $email = $_POST['email'];
   $insta = $_POST['insta'];
   $facebook = $_POST['facebook'];

   $break = explode(" ",$user);
   $fname = $break[0];
   $lname = $break[1];
   $qry = "update users set `fname`='$fname',`lname`='$lname',`email`='$email' where id='$id'";
   mysqli_query($con,$qry);
   $_SESSION['auth_user']['user_email']=$email;
   $_SESSION['auth_user']['username']=$user;
}
?>

