<?php
include('./config/dbconn.php');
include('./errors/message.php');
?>



<!DOCTYPE html>
<html>

<head>
  <title>register</title>
  <script src="jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
  <link href="assets/img/favicon.png" rel="icon">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap" rel="stylesheet">

  <style>
    .cust {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
    }

    #bd {
      display: none;
    }

    input {
      outline-color: #e8288e;
    }

    .header {
      color: #e8288e;
      font-weight: 400;
    }

    .rvt {
      font-size: 40px;
      color: #e8288e;
      text-decoration: none;
      font-weight: 600;
      font-family: 'Raleway', sans-serif;
    }

    .btn {
      background-color: #e8288e;
      outline: #e8288e;
      border: none;
    }
  </style>
</head>

<body id="bd">


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
      <form action="registercode.php" method="POST" class="form">
        <h1 class="header">Register User</h1><br>
        <div class="row gy-4">
          <div class="col-md-8">
            <input type="text" required name="fname" class="form-control" placeholder="Fname" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="text" required name="lname" class="form-control" placeholder="Lname" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="email" required name="email" class="form-control" placeholder="Email" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="password" required name="password" class="form-control" placeholder="Password" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="password" required name="cpassword" class="form-control" placeholder="Confirm Password" id="staticEmail">
          </div>

          <div class="col-md-8">
            <input type="submit" name="register" class="btn btn-primary col-md-3" value="Register">
          </div>

        </div>
      </form>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $("#bd").fadeIn(1500);
    })
  </script>
</body>