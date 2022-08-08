<?php
// session_start();
include('C:\xampp\htdocs\myproj\errors\message.php');
if(!isset($_SESSION['auth_role']))
{
    $_SESSION['message']="You need to login first!!";
    header("location:login.php");
    exit(0);
}
?>
