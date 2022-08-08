<?php 
session_start();
include('./config/dbconn.php');

if($_SERVER['REQUEST_METHOD']=='POST')
{
    if(isset($_POST['register']))
{
    
    $fname =mysqli_real_escape_string($con,$_POST['fname']);
    $lname = mysqli_real_escape_string($con,$_POST['lname']);
    $email =mysqli_real_escape_string($con,$_POST['email']); 
    $password = mysqli_real_escape_string($con,$_POST['password']);
    $cpassword = mysqli_real_escape_string($con,$_POST['cpassword']);

    if($password == $cpassword)
    {
        //validating the email
        $checkmail = "SELECT email FROM users WHERE email ='$email'";
        $checkmail_fire = mysqli_query($con,$checkmail);
        if(mysqli_num_rows($checkmail_fire) > 0)
        {
            //email already exists
            $_SESSION['message']='email already exists';
            header("location:register.php");
            exit(0);
        }
        else
        {
            $user_query = "INSERT INTO users (fname,lname,email,password) VALUES('$fname','$lname','$email','$password')";
            $user_query_fire = mysqli_query($con,$user_query);

            if($user_query_fire)
            {
                $_SESSION['message']='Registered Successfully!';
                header("location:login.php");
                exit(0);
            }
            else
            {
                $_SESSION['message']='Something went wrong!!';
                header("location:register.php");
                exit(0);
            }
        }
    }
    else
    {
    $_SESSION['message'] = "password does not match with confirm password";
    header("location:register.php");
    exit(0);
    }
}
else
{
    $_SESSION['message']="You are not allowed";
    header("location:register.php");
    exit(0);

}
}

?>