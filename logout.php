<?php
session_start();
unset($_SESSION['auth_user']);
header("location:index.php");
exit(0);
?>