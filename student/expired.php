<?php
include("connection.php");
include("navbar.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired info</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
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
            width: 1500px;
            background-color: #7a716a;
            border-radius: 10px;
            /* text-align: center; */
            color: white;
        }

        .container h3 {
            color: white;
        }

        th,
        td {
            width: 10%;
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
        <br>
        <h3 class="text-success bg-light rounded-pill" style="text-align: center;">Return Date Expired</h3>
        <hr>

        <?php
        if (isset($_SESSION['login_user'])) {
            ?>
        <!--------------------------------- search box for finding request book ------------------------------------->

        <div class="srch">
            <div>
                <form action="" method="POST" name="form2">

                    <!---------------------------- RETURN and EXPIRED button --------------------->
                    <div class="d-flex justify-content-start">
                        <div class="d-flex justify-content-start" style="">
                            <button class="btn btn-success" name="submit2" type="submit">RETURNED</button>
                            <button class="btn btn-danger ms-2" name="submit3" type="submit">EXPIRED</button>
                        </div>
                    </div>
                    <!------------------------end RETURN and EXPIRED button code --------------------->
                </form>
            </div>

            <div style="float:right;">
                <p>Late fine <b> 20 Rs./day</b></p>

                <?php
                $var = 0;
                $result = mysqli_query($db, "SELECT * FROM `fine` WHERE username='$_SESSION[login_user]' AND status = 'not paid' ");
                while ($r = mysqli_fetch_assoc($result)) {
                    $var = $var + $r['fine'];
                }
                $var2 = $var + $_SESSION['fine'];
                ?>

                <h2>Your Fine is:
                    <?php
                    echo $var2;
                    ?>
                    Rs. only
                </h2>
            </div>
        </div>

        <?php
        }




        $ret = '<p style="color:yellow; background-color:green;">RETURNED</p>';
        $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
        if (isset($_POST['submit2'])) {
            $sql = "SELECT student.username,roll,books.bid,name,authors,edition,approv,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv ='$ret' ORDER BY `issue_book`.`return` DESC";
            $res = mysqli_query($db, $sql);
        } else if (isset($_POST['submit3'])) {
            $sql = "SELECT student.username,roll,books.bid,name,authors,edition,approv,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv ='$exp' ORDER BY `issue_book`.`return` DESC";
            $res = mysqli_query($db, $sql);
        } else {
            $sql = "SELECT student.username,roll,books.bid,name,authors,edition,approv,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv !='' and issue_book.approv !='yes' ORDER BY `issue_book`.`return` DESC";
            $res = mysqli_query($db, $sql);
        }


        ?>
        <table class="table table-bordered border-primary ms-2 m-2" style="width:98%">
            <tr class="table-warning">
                <th scope="col">Username</th>
                <th scope="col">Roll NO</th>
                <th scope="col">Book ID</th>
                <th scope="col">Book Name</th>
                <th scope="col">Author</th>
                <th scope="col">Edition</th>
                <th scope="col">Approve</th>
                <th scope="col">Issue Date</th>
                <th scope="col">Return Date</th>
            </tr>
        </table>

        <div id="" style="overflow:scroll; height:350px;" class="m-1">
            <table class="table table-bordered border-primary">
                <?php
                while ($data = mysqli_fetch_array($res)) {
                    ?>
                <tbody>
                    <tr class="table-primary">
                        <th scope="row">
                            <?php echo $data['username']; ?>
                        </th>
                        <td>
                            <?php echo $data['roll']; ?>
                        </td>
                        <td>
                            <?php echo $data['bid']; ?>
                        </td>
                        <td>
                            <?php echo $data['name']; ?>
                        </td>
                        <td>
                            <?php echo $data['authors']; ?>
                        </td>
                        <td>
                            <?php echo $data['edition']; ?>
                        </td>
                        <td>
                            <?php echo $data['approv']; ?>
                        </td>
                        <td>
                            <?php echo $data['issue']; ?>
                        </td>
                        <td>
                            <?php echo $data['return']; ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>

    </div>
</body>

</html>