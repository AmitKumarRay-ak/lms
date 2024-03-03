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
    .left_box {
        height: 700px;
        width: 550px;
        float: left;
        background-color: #8ecdd2;
    }

    .left_box2 {
        height: 600px;
        width: 350px;
        background-color: #537899;
        border-radius: 20px;
        float: right;
        margin-right: 30px;
        margin-top: 30px;
    }

    .left_box input {
        width: 150px;
        height: 30px;
        background-color: #537899;
        margin: 10px;
        margin-left: 50px;
        padding: 10px;
        border: 1px solid white;
        border-radius: 10px;
    }

    .right_box {
        height: 700px;
        width: 950px;
        float: right;
        background-color: #8ecdd2;
        display: flex;
    }

    .right_box2 {
        height: 600px;
        width: 600px;
        background-color: #537899;
        border-radius: 20px;
        float: left;
        margin-left: 30px;
        margin-top: 30px;
    }

    .list1 {
        margin-top: 20px;
        height: 500px;
        width: 300px;
        background-color: #537899;
        margin-left: 24px;
        color: red;
        padding: 10px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .list2 {
        margin-top: 20px;
        height: 560px;
        width: 550px;
        background-color: #537899;
        margin-left: 24px;
        color: red;
        padding: 10px;
        overflow-y: scroll;
        overflow-x: hidden;
    }

    .t1 {
        width: 100%;
        padding: 2px;
    }

    tr {
        border-top: 2px solid white;
    }

    tr:hover {
        background-color: #5c5b5e;
        cursor: pointer;
        border-top: 2px solid red;
    }

    .td1 {
        margin-left: 10px;
    }




    .form-control {
        width: 77%;
        margin-left: 21px;
    }

    .msg {
        height: 450px;
        overflow-y: scroll;
    }

    .chat {
        display: flex;
        flex-flow: row wrap;
        padding-left: 40px;
    }

    .user .chatbox {
        height: 47px;
        width: 450px;
        background-color: #306e2b;
        padding: 13px 10px;
        border-radius: 10px;

    }

    .admin .chatbox {
        height: 47px;
        width: 450px;
        background-color: #622612;
        padding: 13px 10px;
        border-radius: 10px;
        order: -1;
    }
</style>

<body style="">


    <?php
    $sql1 = mysqli_query($db, "SELECT student.pic,message.username FROM student INNER JOIN message ON student.username=message.username GROUP BY username ORDER BY status");
    ?>
    <!---------------------------------------------- left box ------------------------------------------>
    <div class="left_box">
        <div class="left_box2">
            <div>
                <form method="POST" action="" enctype="multipart/form-data">
                    <input type="text" name="username" id="uname" style="color:white;">
                    <button style="border-radius:25px;" type="submit" name="submit" class="btn-light">SHOW</button>
                </form>
            </div>
            <div class="list1">
                <?PHP
                echo "<table class='t1' id='table'>";
                while ($res1 = mysqli_fetch_assoc($sql1)) {

                    echo "<tr height=75 class=''>";

                    echo "<td width=65>";
                    echo "<img class='td1 rounded-circle shadow-4-strong' height=60 width=60 src='images/p.png' alt='Error'>";
                    echo "</td>";

                    echo "<td style='padding-left:20px;' class='text-white'>";
                    echo $res1['username'];
                    echo "</td>";

                    echo "</tr>";

                }

                echo "</table>";
                ?>
            </div>
        </div>
    </div>
















    


    <!---------------------------------------------- right box ------------------------------------------>
    <div class="right_box">
        <div class="right_box2">
            <!-- <div class="list2"></div> -->
            <br>
            <?php


            // ----------------------------------------------- if submit is pressed --------------------------------------
            if (isset($_POST['submit'])) {
                $res = mysqli_query($db, "SELECT * FROM message WHERE username='$_POST[username]' ");

                mysqli_query($db, "UPDATE `message` SET `status`='yes' WHERE sender='student' AND username='$_POST[username]' ");


                if ($_POST['username'] != '') {
                    $_SESSION['username'] = $_POST['username'];
                }
                ?>


                <div style="height:70px; width:100%; text-align:center; color:white;">
                    <h3 style="margin-top:-20px; padding-top:10px;">
                        <?php echo $_SESSION['username']; ?>
                    </h3>
                </div>


                <!-- show message area start -->
                <div class="msg">

                    <?php
                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($row['sender'] == 'student') {

                            ?>
                            <!-------------------------------------- student chat--------------------------------->
                <br>
                <div class="chat user">
                    <div style="float:left; padding-top:5px;">
                        <!-- &nbsp; -->
                                    <?php
                                    // echo "<img class='img-circle profile_img' style='height:40px; width:40px;' src='images/" . $_SESSION['pic'] . " '>";
                                    ?>
                                    <!-- &nbsp; -->

                                    &nbsp;
                                    <img style='height:40px; width:40px;' src="images/p.png" alt="">
                                    &nbsp;
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
                                    <!-- &nbsp;
                                    <img style='height:40px; width:40px;' src="images/p.png" alt="">
                                    &nbsp; -->
                                    &nbsp;
                                    <?php
                                    echo "<img class='img-circle profile_img' style='height:40px; width:40px;' src='images/" . $_SESSION['pic'] . " '>";
                                    ?>
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
            <!-- show message area end -->


                <div style="height:50px; padding-top:10px;">
                    <form action="" method="POST">
                        <input type="text" name="message" class="form-control" required="" placeholder="Write Message..."
                            style="float:left;">
                        <button type="submit" name="submit1" class="btn btn-info ms-2"><i
                                class="fa-solid fa-paper-plane"></i>&nbsp;SEND</button>
                    </form>
                </div>
                <?php
            }
            // ------------------------------------ if submit is not pressed --------------------------------------
            else {
                // if($_SESSION['username']=='')
                if (isset($_SESSION['username']) == '') {
                    ?>
                    <img style=" height:40%; width:40%; margin:100px 170px; border-radius:50%;" src="images/tenor.gif"
                        alt="animated">
                    <?php

                } else {

                    if (isset($_POST['submit1'])) {

                        mysqli_query($db, "INSERT INTO `message` (`username`, `message`, `status`, `sender`) VALUES ('$_SESSION[username]','$_POST[message]','no','admin')");
                        $res = mysqli_query($db, "SELECT * FROM message WHERE username='$_SESSION[username]' ");

                    } else {

                        $res = mysqli_query($db, "SELECT * FROM message WHERE username='$_SESSION[username]' ");

                    }
                    ?>
                    <div style="height:70px; width:100%; text-align:center; color:white;">
                        <h3 style="margin-top:-20px; padding-top:10px;">
                            <?php echo $_SESSION['username']; ?>
                        </h3>
                    </div>


                    <!-- show message area start -->
                    <div class="msg">

                        <?php
                        while ($row = mysqli_fetch_assoc($res)) {
                            if ($row['sender'] == 'student') {

                                ?>
                                <!-------------------------------------- student chat--------------------------------->
                <br>
                <div class="chat user">
                    <div style="float:left; padding-top:5px;">
                        <!-- &nbsp; -->
                                        <?php
                                        // echo "<img class='img-circle profile_img' style='height:40px; width:40px;' src='images/" . $_SESSION['pic'] . " '>";
                                        ?>
                                        <!-- &nbsp; -->

                                        &nbsp;
                                        <img style='height:40px; width:40px;' src="images/p.png" alt="">
                                        &nbsp;
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
                                        <!-- &nbsp;
                                        <img style='height:40px; width:40px;' src="images/p.png" alt="">
                                        &nbsp; -->

                                        &nbsp;
                                        <?php
                                        echo "<img class='img-circle profile_img' style='height:40px; width:40px;' src='images/" . $_SESSION['pic'] . " '>";
                                        ?>
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
            <!-- show message area end -->

                    <div style="height:50px; padding-top:10px;">
                        <form action="" method="POST">
                            <input type="text" name="message" class="form-control" required="" placeholder="Write Message..."
                                style="float:left;">
                            <button type="submit" name="submit1" class="btn btn-info ms-2"><i
                                    class="fa-solid fa-paper-plane"></i>&nbsp;SEND</button>
                        </form>
                    </div>
                    <?php

                }
            }

            ?>


        </div>
    </div>





    <script>
        var table = document.getElementById('table'), eIndex;
        for (var i = 0; i < table.rows.length; i++) {
            table.rows[i].onclick = function () {
                rIndex = this.rowIndex;
                document.getElementById("uname").value = this.cells[1].innerHTML;
            }
        }
    </script>
</body>

</html>