<?php
include("connection.php");
include("navbar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
</head>
<style>
    .wrapper {
        height: 600px;
        width: 500px;
        background-color: #313332;
        opacity: .9;
        margin: 30px auto;
        padding: 10px;
    }

    .form-control {
        width: 77%;
    }

    .msg {
        height: 450px;
        overflow-y: scroll;
    }

    .chat {
        display: flex;
        flex-flow: row wrap;
    }

    .user .chatbox {
        height: 47px;
        width: 400px;
        background-color: #306e2b;
        padding: 13px 10px;
        border-radius: 10px;
        order: -1;
    }

    .admin .chatbox {
        height: 47px;
        width: 400px;
        background-color: #622612;
        padding: 13px 10px;
        border-radius: 10px;
    }
</style>

<body style="background-color:#424544; color:white;">


    <?php
    if (isset($_POST['submit'])) {
        mysqli_query($db, "INSERT INTO `library`.`message` (`username`, `message`, `status`, `sender`) VALUES ('$_SESSION[login_user]','$_POST[message]','no','student')");

        $res = mysqli_query($db, "SELECT * FROM `message` WHERE `username`='$_SESSION[login_user]' ");
    } else {
        $res = mysqli_query($db, "SELECT * FROM `message` WHERE `username`='$_SESSION[login_user]' ");
    }
    mysqli_query($db, "UPDATE `message` SET `status`='yes' WHERE sender='admin' AND username='$_SESSION[login_user]' ");
    ?>




    <div class="wrapper">
        <div style="height:70px; width: 100%; text-align:center;">
            <h3 class="text-warning" style="padding-top:10px;">Admin</h3>
            <hr>
        </div>

        <div class="msg">

            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                if ($row['sender'] == 'student') {

                    ?>
                    <!-------------------------------------- student chat--------------------------------->
            <br>
            <div class="chat user">
                <div style="float:left; padding-top:5px;">
                    &nbsp;
                    <?php
                    echo "<img class='img-circle profile_img rounded-circle' style='height:40px; width:40px;' src='images/" . $_SESSION['pic'] . " '>";
                    ?>&nbsp;
                </div>
                <div style="float:left;" class="chatbox">
                    <?php
                    echo $row['message'];
                    ?>
                </div>
            </div>
            <!-------------------------------------- End student chat--------------------------------->

            <?php
                } else {
                    ?>

            <!----------------------------------------- Admin chat------------------------------------>
                    <br>
                    <div class="chat admin">
                        <div style="float:left; padding-top:5px;">
                            &nbsp;
                            <img class="rounded-circle" style='height:40px; width:40px;' src="images/p.png" alt="">
                            &nbsp;
                        </div>
                        <div style="float:left;" class="chatbox">
                            <?php
                            echo $row['message'];
                            ?>
                        </div>
                    </div>
                    <!-------------------------------------- End Admin chat--------------------------------->
            <?php
                }
            }
            ?>
        </div>

        <div style="height:100px; padding-top:10px;">
            <form action="" method="POST">
                <input type="text" name="message" class="form-control" required="" placeholder="Write Message..."
                    style="float:left;">
                <button type="submit" name="submit" class="btn btn-info ms-2"><i
                        class="fa-solid fa-paper-plane"></i>&nbsp;SEND</button>
            </form>
        </div>
    </div>






</body>

</html>