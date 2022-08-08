<?php
include('./config/dbconn.php');
$id = $_GET['id'];
$qry="delete from cart where `pro_id`=$id";
$res=mysqli_query($con,$qry);
if($res)
{
    header("location:cart-show.php");
}
?>