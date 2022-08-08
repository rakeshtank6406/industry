<?php
session_start();
include('./config/dbconn.php');
if(isset($_POST['login']))
{
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);

    $login_query ="select * from users where email ='$email' and password = '$password' limit 1"; 
    $login_query_fire = mysqli_query($con,$login_query);

    if(mysqli_num_rows($login_query_fire) > 0)
    {
        foreach($login_query_fire as $data)
        {
            $user_id = $data['id'];
            $username = $data['fname']." ".$data['lname'];
            $user_email = $data['email']; 
            $role_as = $data['role_as']; 
        }
        $_SESSION['auth']=true;
        $_SESSION['auth_role'] = "$role_as"; 
        
        $_SESSION['auth_user'] =
        [
            'user_id'=>$user_id, 
            'username'=>$username,
            'user_email'=>$user_email,
            'photo'=>1
        ];
        if($_SESSION['auth_role'] =='1') // 1 means admin
        {
            $_SESSION['message']="Welcome to dashboard";
            header("location:admin/index.php");
            exit(0);

        }
        elseif($_SESSION['auth_role']=='0') // 0 means user
        {
            // $_SESSION['message']="You are logged in!!"; // first bug in my life
            header("location:index.php");
            exit(0);
        }


    }
    else
    {
        $_SESSION['message'] = "Invalid email or password";
        header("location:login.php");
        exit(0);
    }
}
else
{
    $_SESSION['message'] ="you are not allowed";
    header("location:login.php");
    exit(0);
}
?>