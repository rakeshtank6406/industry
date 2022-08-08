<?php
session_start();
include('./config/dbconn.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div class="container">
        <div id="load" class="profile">
            <div id="toggle" class="setting"> <span>Edit&nbsp;&nbsp;</span> <i class="fa-solid fa-gear"></i></div>
            <div id="toggle2" class="setting"> <span>Save&nbsp;&nbsp;</span><i class="fa-solid fa-floppy-disk"></i></div>
            <div id="back" class="back"> <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a></div>
            <div class="circle">
                <?php

                $uid = $_SESSION['auth_user']['user_id'];
                $sqq = "select * from profile where id = $uid";
                $result = mysqli_query($con, $sqq);
                $row = mysqli_fetch_row($result);

                if ($row > 0) {
                    $path = $row[2];
                } else {
                    $sqq = "select * from profile where id =0";
                    $result2 = mysqli_query($con, $sqq);
                    $rows = mysqli_fetch_row($result2);
                    $path = $rows[2];
                }

                // Update Image
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['submit'])) {
                        if (isset($_FILES['file']) && !empty($_FILES['file'])) {
                            $file_name = $_FILES['file']['name'];
                            $file_types = array('png', 'jpg', 'jpeg', 'webp');
                            $extension = explode('.', $file_name);

                            if (!in_array($extension[1], $file_types)) {
                                echo "invalid file type";
                                exit();
                            } else {
                                $final_name = $extension[0] . time() . "." . $extension[1];
                                $final_path = './profile/' . $final_name;
                                $id = $_SESSION['auth_user']['user_id'];
                                if (move_uploaded_file($_FILES['file']['tmp_name'], $final_path)) {
                                    if ($row > 0) {
                                        $qry = "update profile set `img_name`='$file_name',`img_path`='$final_path' where id =$id";
                                        $res = mysqli_query($con, $qry);
                                        header("location:profile.php");
                                    } else {
                                        $qry = "insert into profile values($id,'$file_name','$final_path','')";
                                        $res = mysqli_query($con, $qry);
                                        header("location:profile.php");
                                    }
                                }
                            }
                        }
                    }
                }
                ?>
                <img id="img" class="wp" src="<?php echo $path; ?>" alt="<?php echo $path; ?>">
                <div id="edit" class="edit">
                    <span>Edit Photo</span>
                </div>
            </div>
            <div class="popup">
                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <input name="file" type="file"><br><input name="submit" id="submit" type="submit">
                </form>
            </div>
            <div class="content">
                <h1 id="uname" class="wp"><?php echo $_SESSION['auth_user']['username'] ?></h1>
                <input id="uname2" name="username" value="<?php echo $_SESSION['auth_user']['username'] ?>" type="text">
            </div>
            <div class="second-content">
                <table>
                    <tr>
                        <td><i class="fa-solid fa-envelope"></i></td>
                        <td>
                            <p class="data wp"><?php echo $_SESSION['auth_user']['user_email'] ?></p>
                            <input class="data1" id="email" value="<?php echo $_SESSION['auth_user']['user_email'] ?>" type="text">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#toggle").click(function() {
                $("#edit").show(500);
                $("#edit").css("display", "flex");
                $("#toggle").hide();
                $("#toggle2").show(500);
                $("#toggle2").css("display", "flex");
                $("#uname").hide();
                $(".data").hide();
                $("#uname2").show(500);
                $(".data1").show(500);
            });

            $(".edit").click(function() {
                $(".popup").show(500);
                $(".popup").css("display", "flex");
            })

            $("#toggle2").click(function() {
                let username = jQuery('#uname2').val();
                let email = jQuery('#email').val();
                let insta = jQuery('#insta').val();
                let facebook = jQuery('#facebook').val();

                $.ajax({
                    url: "ajax.php",
                    type: "post",
                    data: {
                        'username': username,
                        'email': email,
                        'insta': insta,
                        'facebook': facebook
                    },
                    success: function() {
                        $("#edit").hide(500);
                        $("#toggle2").hide();
                        $("#toggle").show(500);
                        $("#toggle").css("display", "flex");
                        $("#uname2").hide();
                        $(".data1").hide();
                        $("#uname").show(500);
                        $(".data").show(500);
                        window.location.href = "profile.php";
                    },
                });
            });
            $(".wp").show(500);
        });
    </script>

</body>

</html>