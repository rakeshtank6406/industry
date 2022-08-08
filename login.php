<?php

include('./config/dbconn.php');
include('./errors/message.php');
if (isset($_POST['email']) && $_POST['email'] != '') {
  $mail = $_POST['email'];
  $_SESSION['mail'] = $mail;
  $qry = "select `email` from users where `email` = '$mail'";
  $res = mysqli_query($con, $qry);
  $emails = mysqli_fetch_array($res);
  // print_r($emails);
  // echo $mail;
  if (in_array($mail, $emails)) {
    $valid = 1;
  } else {
    $valid = $mail;
  }
  echo $valid;
  exit();
}

if (isset($_POST['pass']) && $_POST['pass'] != '') {
  $pass = $_POST['pass'];
  $mail = $_SESSION['mail'];
  $qry = "update users set `password`='$pass' where `email`='$mail'";
  $res = mysqli_query($con, $qry);
  if ($res) {
    $valid = 1;
  } else {
    $valid = 0;
  }
  echo $valid;
  exit();
}


?>

<!DOCTYPE html>
<html>

<head>
  <title></title>
  <link rel="stylesheet" type="text/css" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link href="assets/img/favicon.png" rel="icon">

  <script src="jquery-3.6.0.min.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

  <style>
    #bd {
      display: none;
      position: relative;
    }

    .cust {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
    }

    input {
      outline-color: #e8288e;
    }

    .header {
      color: #e8288e;
    }

    .forget {
      color: #e8288e;
      cursor: pointer;
    }

    .box {
      display: flex;
      justify-content: center;
      align-items: center;
      color: #e8288e;
    }

    .popup {
      position: absolute;
      height: 100vh;
      width: 100vw;
      background-color: rgba(255, 255, 255, 0.8);
      display: none;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .popup .inner-pop {
      height: 500px;
      width: 700px;
      border-radius: 30px;
      position: relative;
      background-color: rgba(187, 67, 189, 0.551);
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }

    .first {
      display: flex;
      align-items: center;
      flex-direction: column;
    }

    .popup input[type="checkbox"] {
      background-color: transparent;
    }

    .popup input[type="button"] {
      background-color: transparent;
      border: none;
    }

    .popup input[type="email"],
    .popup input[type="password"],
    .popup input[type="text"] {
      border: none;
      width: 400px;
      text-align: center;
      background-color: transparent;
      border-bottom: 2px solid white;
    }

    #close {
      position: absolute;
      right: 5%;
      top: 5%;
    }

    .popup input::placeholder,
    .popup input[value] {
      color: white;
    }

    .rvt {
      font-size: 40px;
      color: #e8288e;
      text-decoration: none;
      font-weight: 600;
      font-family: 'Raleway', sans-serif;
    }

    .second {
      display: none;
    }

    .btn {
      background-color: #e8288e;
      outline: #e8288e;
      border: none;
    }
  </style>
</head>

<body id="bd">
  <div class="popup">
    <div class="inner-pop">
      <img src="icons8-close.svg" id="close">
      <div class="first">
        <input id="mail" type="email" placeholder="Enter your email"><br>
        <input id="reset" class="reset" type="button" value="Check"></input>
      </div>
      <div class="second">
        <input class="final" type="password" id="pass" placeholder="Enter new Password">
        <div class="final" class="box"> <input type="checkbox" name="show" id="show">&nbsp;<span>show password</span></div>
        <input type="button" id="aj2" value="Reset password"></input>
      </div>
    </div>
  </div>

  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex text-center align-items-center justify-content-left">

      <a href="index.php" class="logo d-flex rvt  align-items-center">
        <span>RVT Industries</span>
      </a>
    </div>
  </header>
  <div class="container cust">

    <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
      <img src="assets/img/hero-img-1 (2).png" class="img-fluid" alt="">
    </div>

    <div class="col-lg-6">
      <form action="logincode.php" method="POST" class="form">
        <h1 class="header">Login Here</h1><br>
        <div class="row gy-4">

          <div class="col-md-8">
            <input type="email" required name="email" class="form-control" placeholder="Email" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="password" required name="password" class="form-control" placeholder="Password" id="staticEmail">
          </div>

          <div class="row-md-6">
            <input type="submit" name="login" class="btn btn-primary col-md-3" value="Login">
            <a href="register.php" name="register" class="btn btn-primary col-md-3" value="register">Register</a>
          </div>
          <div class="forget">forget password?</div>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#bd").fadeIn(1000);
      $("#bd").css("display", "block");
      $(".forget").click(function() {
        $(".popup").fadeIn(500);
        $(".popup").css("display", "flex");
      })

      $("#close").click(function() {
        $(".popup").fadeOut(500);
      })

      $("#reset").click(function() {
        let email = $("#mail").val();
        var FormData = {
          email: email
        }
        $.ajax({
          url: "login.php",
          type: "POST",
          data: FormData,
          success: function(response) {
            if (response == 1) {
              $(".first").hide();
              $(".second").fadeIn(500);
            } else {
              alert("Email not found");
            }
          }
        });
      });
      var shw = document.getElementById("show");
      shw.addEventListener("click", check)

      function check() {
        if (document.getElementById("pass").type == "password") {
          // $("#pass").attr("type", "text");
          document.getElementById("pass").type = "text";
        } else {
          // $("#pass").attr("type", "password");
          document.getElementById("pass").type = "password";
          // console.log("clicked");
        }
      }

      $("#aj2").click(function() {
        let pass = $("#pass").val();
        var FormData = {
          pass: pass
        }
        $.ajax({
          url: "login.php",
          type: "POST",
          data: FormData,
          success: function(response) {
            if (response == 1) {
              $(".second").hide();
              $(".first").fadeIn(500);
              $(".popup").hide();
              document.querySelector("#mail").value = "";
              document.querySelector("#pass").value = "";
              alert("password updated successfully!!");
            } else {
              alert("Password should not empty!!");
            }
          }
        });
      });
    })
  </script>
</body>