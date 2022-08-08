<?php
session_start();
$user = $_SESSION['auth_user']['username'];
include('./config/dbconn.php');
$sql = "select pro_id from cart where `user_name`='$user'";
$fire = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="./cart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <?php
        $i = 0;
        echo
        '
        <script>
        var id=[];
        </script>
        ';
        while ($row = mysqli_fetch_array($fire)) {
            $pro_id = $row['pro_id'];
            $qry = "select * from product where `pid`=$pro_id";
            $fire2 = mysqli_query($con, $qry);
            while ($row2 = mysqli_fetch_array($fire2)) {
                echo '
                <div class="items">
                <div class="inner"><img src="./products/' . $row2['image'] . '"></div>
                <div class="inner"><b>' . $row2['name'] . '</b></div>
                <div class="inner"><b id="price' . $i . '">' . $row2['price'] . '</b></div>
                <div class="inner btn"><button id="minus" onclick="minus(' . $i . ')">-</button></div>
                <div class="inner"><b id="qty' . $i . '">1</b></div>
                <div class="inner btn"><button id="plus" onclick="plus(' . $i . ')">+</button></div>
                <div class="inner"><b id="total' . $i . '">' . $row2['price'] . '</b></div>
                <div class="inner"><a href="cart_del.php?id=' . $pro_id . '"><button id="trash"><i class="fas fa-trash"></i></button></a></div>
                </div>
                <script>
                var i ="total"+' . $i . ';
                var y="total"+' . $i . '
                id.push(i);
                </script>';
                $i++;
            }
        }
        ?>

    </div>
    <hr>
    <div class="total">
        <div class="in-total"><b>total items:</b id="t-item"><b>0</b>
        </div>
        <div class="in-total"><b>Have to pay:</b><b id="t-pay">0</b></div>
        <div class="in-total"><b><a href="#">Pay Now</a></b></div>
    </div>
    <script>
        function plus(i) {
            var qty = document.getElementById("qty" + i);
            var val = parseInt(document.getElementById("qty" + i).innerHTML);
            let price = parseInt(document.getElementById("price" + i).innerHTML);
            let get = val + 1;
            document.getElementById("qty" + i).innerHTML = get;
            document.getElementById("total" + i).innerHTML = price * get;
            //--------------------------
            var maint = 0;
            for (v = 0; v < id.length; v++) {
                let demo = parseInt(document.getElementById(id[v]).innerHTML);
                maint += demo;
            }
            document.getElementById("t-pay").innerHTML = maint;
        }

        function minus(i) {
            var qty = document.getElementById("qty" + i);
            var val = parseInt(document.getElementById("qty" + i).innerHTML);
            if (val != 1) {
                let get = val - 1;
                document.getElementById("qty" + i).innerHTML = get;
                let price = parseInt(document.getElementById("price" + i).innerHTML);
                document.getElementById("total" + i).innerHTML = price * get;
            }
            //--------------------------
            var maint = 0;
            for (v = 0; v < id.length; v++) {
                let demo = parseInt(document.getElementById(id[v]).innerHTML);
                maint += demo;
            }
            document.getElementById("t-pay").innerHTML = maint;
        }
        var maint = 0;
        for (v = 0; v < id.length; v++) {
            let demo = parseInt(document.getElementById(id[v]).innerHTML);
            maint += demo;
        }
        document.getElementById("t-pay").innerHTML = maint;
    </script>

</body>

</html>