<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>

    <style>
        body {
            font-family: "Lato", sans-serif;
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

        @media (min-width: 350px) and (max-width: 640px) {
            .row {
                width: 90%;
                overflow-x: scroll;
                padding: 0;
                margin: 0;
            }

            .table {
                width: 90%;
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
        <div class="side_nav_button"><a href="books.php">Books</a></div>
        <div class="side_nav_button"><a href="request.php">Book Request</a></div>
        <div class="side_nav_button"><a href="issue_info.php">Issue Information</a></div>
        <div class="side_nav_button"><a href="expired.php">Expired Book</a></div>
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


    <center>
        <h2>List of Books</h2>
    </center>
    <hr>

    <!-------------------- searchbar -------------------->
    <div class="d-flex justify-content-end mt-3" style="margin-right:85px">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border border-danger p-2" type="text" name="search"
                    placeholder="search books name ..." required>
                <button type="submit" name="submit" class="btn btn-default border border-success me-4">
                    <i class="fa-solid fa-magnifying-glass fa-beat" style="color: #63E6BE;"></i>
                </button>
            </div>
        </form>
    </div>

    <!------------------ request book searchbar ----------------->
    <div class="d-flex justify-content-end mt-3">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border-bottom border-danger p-2" type="text" name="bid"
                    placeholder="Enter Book ID ...">
                <button type="submit" name="submit1" class="btn btn-default border border-success me-4">Request Book
                </button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $q = mysqli_query($db, "SELECT * FROM `books` WHERE name like '%$_POST[search]%' ");

        if (mysqli_num_rows($q) == 0) {
            echo "Sorry!  No Books Found.  Try Searching Other Book";
        } else {
            ?>

    <div class="row m-3">
        <div class="col">
            <table class="table table-bordered border-primary">
                <thead>
                    <tr class="table-warning">
                        <th scope="col">ID</th>
                        <th scope="col">Book Name</th>
                        <th scope="col">Author Name</th>
                        <th scope="col">Edition</th>
                        <th scope="col">Status</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Department</th>
                        <th scope="col">Price</th>
                    </tr>
                    <?php
                    // $sql = "SELECT * FROM `books`";
                    // $result = mysqli_query($con, $sql);
            
                    while ($data = mysqli_fetch_array($q)) { ?>

                </thead>
                <tbody>
                    <tr class="table-primary">
                        <th scope="row">
                            <?php echo $data['bid']; ?>
                        </th>
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
                        <td>
                            <?php echo $data['quantity']; ?>
                        </td>
                        <td>
                            <?php echo $data['department']; ?>
                        </td>
                        <td>
                            <?php echo $data['price']; ?>
                        </td>
                    </tr>

                    <?php

                    } ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php
        }
    }
    //--------------------- if button is not pressed------------------------
    else {
        ?>


    <!-- <center>
        <h2>List of Books</h2>
    </center> -->

        <div class="row m-3">
            <div class="col">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr class="table-warning">
                            <th scope="col">ID</th>
                            <th scope="col">Book Name</th>
                            <th scope="col">Author Name</th>
                            <th scope="col">Edition</th>
                            <th scope="col">Status</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Department</th>
                            <th scope="col">Price</th>
                            <th scope="col">Action</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `books` ORDER BY `name`";
                        $result = mysqli_query($db, $sql);

                        while ($data = mysqli_fetch_array($result)) { ?>

                        </thead>
                        <tbody>
                            <tr class="table-primary">
                                <th scope="row">
                                    <?php echo $data['bid']; ?>
                                </th>
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
                                <td>
                                    <?php echo $data['quantity']; ?>
                                </td>
                                <td>
                                    <?php echo $data['department']; ?>
                                </td>
                                <td>
                                    <?php echo $data['price']; ?>
                                </td>
                                <td>
                                    <button class="btn btn-warning"><a class="text-decoration-none text-black" href="#">Buy
                                            Now</a></button>
                                </td>
                            </tr>

                            <?php

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>


        <?php
    }
    ?>




    <!------------------------------- php code for book request -------------------------->

    <?php
    if (isset($_POST['submit1'])) {

        if (isset($_SESSION['login_user'])) {

            $sql1 = mysqli_query($db, "SELECT * FROM `books` WHERE bid='$_POST[bid]' ");
            $row1 = mysqli_fetch_assoc($sql1);
            $count1 = mysqli_num_rows($sql1);

            if ($count1 != 0) {
                mysqli_query($db, "INSERT INTO `issue_book`(`username`, `bid`, `approv`, `issue`, `return`) VALUES ('$_SESSION[login_user]','$_POST[bid]','','','')");
                ?>
                <script>
                    window.location = "request.php";
                </script>
                <?php
            } else {
                ?>
                <script>
                    alert("Book is Not Exist in Liblary.");
                </script>
                <?php
            }
        } else {
            ?>
            <script>
                alert("You Need To Login First For Request A Book");
            </script>
            <?php
        }
    }
    ?>

</body>

</html>