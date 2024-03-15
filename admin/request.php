<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Request</title>
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
            text-align: center;
            color: white;
        }

        .container h3 {
            color: white;
        }

        @media (min-width: 350px) and (max-width: 800px) {
            .container {
                width: 90%;
                overflow-x: scroll;
            }

            .table {
                width: 90%;
            }

            .form-outline {
                display: block;
                justify-content: center;
                align-items: center;
                padding: 10px;
            }

            .row .col h3 {
                margin-top: 20px;
            }

            .res {
                margin: 10px;
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
        <div class="row">
            <div class="col">
                <h3>List Of Requested Book</h3>
                <hr style="color:white;">
                <!--------------------------------- search box for finding request book ------------------------------------->
                <div class="srch">
                    <form action="" method="POST" name="form1">
                        <div class="d-flex justify-content-end mt-3">
                            <div class="form-outline" data-mdb-input-init>
                                <input class="res rounded-pill border border-danger p-2" type="text" name="username"
                                    placeholder="username" required>
                                <input class="res rounded-pill border border-danger p-2" type="text" name="bid"
                                    placeholder="book id" required>
                                <button type="submit" name="submit"
                                    class="res btn btn-default border border-warning me-4">
                                    <i class="fa-solid fa-magnifying-glass fa-beat" style="color: #c99e26;"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


                <?php
                if (isset($_POST['submit'])) {
                    $_SESSION['name'] = $_POST['username'];
                    $_SESSION['bid'] = $_POST['bid'];
                    ?>
                <script>
                    window.location = "approve.php";
                </script>
                <?php
                }
                ?>
                <!---------------------------------End search box for finding request book ------------------------------------->


                <div id="" style="overflow:scroll; height:460px;" class="m-1">
                    <?php

                    if (isset($_SESSION['login_user'])) {
                        // $sql = "SELECT student.username, roll, books.bid, name, authors, edition, status 
                        //         FROM student 
                        //         INNER JOIN issue_book ON student.username = issue_book.username 
                        //         INNER JOIN books ON issue_book.bid = books.bid 
                        //         WHERE issue_book.approv IS NULL OR issue_book.approv = ''
                        //         GROUP BY books.bid";

                        $sql = "SELECT student.username, roll, books.bid, name, authors, edition, status 
                                FROM student 
                                INNER JOIN issue_book ON student.username = issue_book.username 
                                INNER JOIN books ON issue_book.bid = books.bid 
                                WHERE issue_book.approv IS NULL OR issue_book.approv = '' 
                                GROUP BY student.username, roll, books.bid, name, authors, edition, status";



                        $res = mysqli_query($db, $sql);


                        if (mysqli_num_rows($res) == 0) {
                            echo "<h2>";
                            echo "There is no any request";
                            echo "</h2>";
                        } else {
                            ?>
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">Username</th>
                                <th scope="col">Roll NO</th>
                                <th scope="col">Book ID</th>
                                <th scope="col">Book Name</th>
                                <th scope="col">Author</th>
                                <th scope="col">Edition</th>
                                <th scope="col">status</th>
                            </tr>
                            <?php

                            while ($data = mysqli_fetch_array($res)) { ?>

                        </thead>
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
                                    <?php echo $data['status']; ?>
                                </td>
                            </tr>

                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                    <?php
                        }
                    } else {
                        ?>
                    <h3 class="text-warning">Login First Then You See Requested Book</h3>
                    <?php
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>

</body>

</html>