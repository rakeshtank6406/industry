<?php
include("../config/dbconn.php");
if(isset($_POST['send']))
{
  $name = $_POST['name'];
  $email = $_POST['email'];
  $subject = $_POST['subject'];
  $message = $_POST['message'];

  $sql = "insert into message values('','$name','$email','$subject','$message')";
  $qry = mysqli_query($con,$sql);
  mysqli_close($con);
  header("location:../index.php");
}

?>