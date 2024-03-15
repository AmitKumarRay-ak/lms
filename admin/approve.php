<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
        }
        
        body::-webkit-scrollbar{
            display: none;
        }

        .sidenav {
            height: 100%;
            margin-top: 65px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #333032;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        .side_nav_button a {
            color: white;
        }

        .side_nav_button:hover {
            color: white;
            width: 300px;
            height: 50px;
            background-color: #acc3e8;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }

        .container {
            height: 600px;
            width: 600px;
            background-color: #7a716a;
            border-radius: 10px;
            text-align: center;
            color: white;
        }

        .container h3 {
            color: white;
        }


        @media (min-width: 525px) and (max-width: 640px) {
            body {
                /* background-color: blue; */
            }

            .container {
                width: 500px;
            }

            .sidenav a {
                padding: 4px 4px 4px 16px;
                text-decoration: none;
                font-size: 20px;
                color: white;
                display: block;
                transition: 0.3s;
            }
        }


        @media (min-width: 250px) and (max-width: 525px) {
            body {
                /* background-color: red; */
            }

            .container {
                width: 400px;
            }

            .sidenav a {
                padding: 4px 4px 4px 16px;
                text-decoration: none;
                font-size: 20px;
                color: white;
                display: block;
                transition: 0.3s;
            }
        }
    </style>
</head>

<body>
    <!---------------------------------------------- sidenav start ----------------------------------------->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="text-decoration-none text-warning" style="font-size: 17px;" href="profile.php">
            <?php
            if (isset($_SESSION['login_user'])) {
                // echo "Welcome : " . $_SESSION['login_user'];
                echo "<img class='img-circle profile_img m-4' style='height:120px; width:120px;' src='images/" . $_SESSION['pic'] . " '>";
                echo "</br>";
                ?>
            <div class="ms-4">
                <?php
                echo "Welcome: " . " " . $_SESSION['login_user'];
                ?>
            </div>
            <?php
            }
            ?>
        </a>
        <hr style="color:white">
        <div class="side_nav_button"><a href="books.php">Books</a></div>
        <div class="side_nav_button"><a href="request.php">Book Request</a></div>
        <div class="side_nav_button"><a href="issue_info.php">Issue Information</a></div>
        <div class="side_nav_button"><a href="expired.php">Expired Information</a></div>
    </div>

    <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
    <!----------------------------------------------- sidenav end ----------------------------------------->



    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Approve Request</h3>
                <hr style="color:white;">
                <br>
                <form action="" method="POST">
                    <div class="form-group">
                        <input type="text" class="form-control" name="approve" placeholder="Approve Status             yes / no"
                            required>
                        <br>

                        <input type="text" class="form-control" name="issue"
                            placeholder="Issue Date                     yyyy-mm-dd" required>
                        <br>

                        <input type="text" class="form-control" name="return"
                            placeholder="Return Date                  yyyy-mm-dd" required>
                        <br>

                        <button class="btn btn-warning btn-block btn-lg" style="width:200px;" type="submit"
                            name="submit">Approve</button>
                    </div>
                </form>

                <?php
                if (isset($_POST['submit'])) {

                    mysqli_query($db, "UPDATE `issue_book` SET `approv`='$_POST[approve]',`issue`='$_POST[issue]',`return`='$_POST[return]' WHERE username='$_SESSION[name]' AND bid='$_SESSION[bid]' ");

                    mysqli_query($db, "UPDATE `books` SET `quantity`=quantity-1 WHERE bid='$_SESSION[bid]' ");

                    $res = mysqli_query($db, "SELECT quantity FROM books WHERE bid='$_SESSION[bid]' ");

                    while ($row = mysqli_fetch_assoc($res)) {
                        if ($row['quantity'] == 0) {
                            mysqli_query($db, "UPDATE `books` SET `status`='not-available' WHERE bid='$_SESSION[bid]' ");
                        }
                    }
                    ?>
                <script>
                    alert("Update Successfull");
                    window.location = "request.php";
                </script>
                <?php
                }
                ?>

            </div>
        </div>
    </div>
</body>

</html>