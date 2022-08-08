<?php
session_start();
include('./config/dbconn.php');
$id=$_GET['id'];
$username=$_SESSION['auth_user']['username'];
$qry2="select * from cart where `pro_id`=$id and `user_name`='$username'";
$sql2=mysqli_query($con,$qry2);
$row=mysqli_num_rows($sql2);
if(!($row > 0))
{
$qry="insert into cart values($id,'$username')";
$sql=mysqli_query($con,$qry);
if($sql)
{
    header("location:products.php");
    exit();
}
}
else
{
    $_SESSION['message']="item already added in cart";
    header('location:products.php');
}

?>