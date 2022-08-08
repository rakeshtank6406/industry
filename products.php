<?php
include("./config/dbconn.php");
session_start();
session_abort();
$qry = "select * from product";
$user=$_SESSION['auth_user']['username'];
$qry2 = "select * from cart where `user_name`='$user'";
$sql = mysqli_query($con, $qry);
$sql2 = mysqli_query($con, $qry2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="product.css">
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./bootstrap-5.1.3-dist/css/bootstrap.min.css">
</head>

<body>
    <?php include('./errors/message.php');?>
    <div class="popup">
        <div class="inner-pop">
            <img src="icons8-close.svg" id="close">
            <div class="idparse"></div>
        </div>
    </div>
    <div class="header">
        <div class="logo">
            <h1>RVT Industries</h1>
        </div>
        <div class="cart">
            <span><a href="index.php"><i class="fa-solid fa-house"></i></a></span>
            <a href="cart-show.php"><i class="fa-solid fa-cart-shopping"></i></a>
            <span id="count"><?php echo mysqli_num_rows($sql2);?></span>
        </div>
    </div>
    <div class="search-main">
        <input type="text" name="search" id="search" autocomplete="off" class="search" placeholder="Type here to search product!!!">
    </div>
    <div class="container">
        <div class="row">
            <?php
            while ($row = mysqli_fetch_array($sql)) {
                $id=$row['pid'];
                echo '   <div class="col-4">
                <div class="card">
                    <img src="./products/' . $row['image'] . '" alt="">
                    <div class="card-body">
                        <div class="row">
                            <div class="card-title">
                                <h4>' . $row['name'] . '</h4>
                                <h3>$' . $row['price'] . '</h3>
                            </div>
                        </div>
                        <hr/>
                        <p>
                            This is readymate demo of website you can buy and directly use in your project and also
                        </p>
                        <div class="btn-group">
                            <div class="btn">
                                <a class="buy" href="cart-in.php?id='.$id.'">Buy Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            }
            ?>


        </div>
    </div>
    <script>
                $(document).ready(function() {
                    $(".detail").click(function() {
                        setTimeout(myGreeting,500);
                       function myGreeting(){
                        $(".popup").fadeIn(500);
                        $(".popup").css("display","flex");
                       }
                    })
                    $("#close").click(function(){
                        $(".popup").fadeOut(500);
                    })
                    $(".buy").click(function(){
                        confirm("Do you want to add this item to cart?");
                    })
                })
            </script>
</body>
</html>