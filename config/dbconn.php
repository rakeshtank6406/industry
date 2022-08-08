<?php
$con = mysqli_connect('localhost','root','','senza');
if(!$con)
{
    header("location : ../errors/message.php");
}

?>