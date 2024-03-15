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

        @media (min-width: 640px) and (max-width: 777px) {
            body {
                /* background-color: red; */
            }

            .x-scroller {
                overflow-x: scroll;
                overflow-y: hidden;
                width: 98%;
            }

            tr th {
                font-size: 10px;
            }

            tr td {
                font-size: 10px;
            }
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


            .x-scroller {
                overflow-x: scroll;
                overflow-y: hidden;
                width: 98%;
            }

            tr th {
                font-size: 10px;
            }

            tr td {
                font-size: 10px;
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


            .x-scroller {
                overflow-x: scroll;
                overflow-y: hidden;
                width: 98%;
            }

            tr th {
                font-size: 10px;
            }

            tr td {
                font-size: 10px;
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
                echo "<img class='rounded-circle m-4' style='height:120px; width:120px;' src='images/" . $_SESSION['pic'] . " '>";
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
        <div class="side_nav_button"><a href="Add.php">Add Books</a></div>
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
        <?php
        if (isset($_POST['submit'])) {

            $res = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username='$_POST[username]' and bid='$_POST[bid]' ");

            while ($row = mysqli_fetch_assoc($res)) {
                $d = strtotime($row['return']);
                $c = strtotime(date("Y-m-d"));

                $diff = $c - $d;

                if ($diff > 0) {
                    $day = floor($diff / (60 * 60 * 24));
                    $fine = $day * 20;
                }
            }
            $x = date("Y-m-d");

            mysqli_query($db, "INSERT INTO `fine`(`username`, `bid`, `returned`, `day`, `fine`, `status`) VALUES ('$_POST[username]','$_POST[bid]','$x','$day','$fine','not paid')");

            $var1 = '<p style="color:yellow; background-color:green;">RETURNED</p>';
            mysqli_query($db, "UPDATE issue_book SET approv='$var1' where username='$_POST[username]' and bid='$_POST[bid]' ");

            mysqli_query($db, "UPDATE books SET quantity=quantity+1 where bid='$_POST[bid]' ");
        }
        ?>
        <div class="srch">
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
            <br>

            <form action="" method="POST" name="form1">
                <div class="d-flex justify-content-end">
                    <div class="form-outline" data-mdb-input-init>
                        <input class="rounded-pill border border-danger p-2" type="text" name="username"
                            placeholder="username" required>
                        <input class="rounded-pill border border-danger p-2" type="text" name="bid"
                            placeholder="book id" required>
                        <button type="submit" name="submit"
                            class="btn btn-warning border border-warning me-4">SUBMIT</button>
                    </div>
                </div>
            </form>
            <br>
        </div>
        <!--------------------------------- END search box for finding request book ------------------------------------->
        <?php
        }
        ?>
        <?php
        $c = 0;
        if (isset($_SESSION['login_user'])) {
            // $sql = "SELECT student.username,roll,books.bid,name,authors,edition,approv,issue,issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv !='' and issue_book.approv !='yes' ORDER BY `issue_book`.`return` DESC";
        
            $ret = '<p style="color:yellow; background-color:green;">RETURNED</p>';
            $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
            if (isset($_POST['submit2'])) {
                $stmt = $db->prepare("SELECT DISTINCT student.username, roll, books.bid, name, authors, edition, approv, issue, issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv = ? ORDER BY `issue_book`.`return` DESC");
                $stmt->bind_param("s", $ret);
                $stmt->execute();
                $res = $stmt->get_result();
            } else if (isset($_POST['submit3'])) {
                $stmt = $db->prepare("SELECT DISTINCT student.username, roll, books.bid, name, authors, edition, approv, issue, issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv = ? ORDER BY `issue_book`.`return` DESC");
                $stmt->bind_param("s", $exp);
                $stmt->execute();
                $res = $stmt->get_result();
            } else {
                $stmt = $db->prepare("SELECT DISTINCT student.username, roll, books.bid, name, authors, edition, approv, issue, issue_book.return FROM student INNER JOIN issue_book ON student.username=issue_book.username INNER JOIN books ON issue_book.bid=books.bid WHERE issue_book.approv = ? ORDER BY `issue_book`.`return` DESC");
                $stmt->bind_param("s", $exp);
                $stmt->execute();
                $res = $stmt->get_result();
            }


            ?>
        <div class="x-scroller">
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


                <?php
                while ($data = mysqli_fetch_array($res)) {
                    ?>
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
            </table>
        </div>
        <?php
        } else {
            ?>
        <h3 style="text-align:center;">Login First to Seen Information of Approved Book</h3>
        <?php
        }
        ?>
    </div>
</body>

</html>