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

        tr td input {
            width: 100px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }


        .responsive-div {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f44f4f;
            color: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (min-width: 350px) and (max-width: 800px) {
            .row1 {
                overflow-x: scroll;
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



    <?php
    // if (isset($_SESSION['login_user'])) {
    $q = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username='$_SESSION[login_user]' and approv='' ;");

    if (mysqli_num_rows($q) == 0) {
        ?>
    <div class="responsive-div">
        <h2>There is no any request</h2>
    </div>
    <?php
    } else {
        ?>

    <form method="POST" action="">
        <div class="row row1 m-3">
            <div class="col col1">



                <table class="table table-bordered border-primary">
                    <thead>
                        <tr class="table-warning">
                            <th scope="col">Select</th>
                            <th scope="col">Book ID</th>
                            <th scope="col">username</th>
                            <th scope="col">Approve Status</th>
                            <th scope="col">Issue Date</th>
                            <th scope="col">Return Date</th>
                        </tr>
                        <?php

                        while ($data = mysqli_fetch_array($q)) { ?>

                    </thead>
                    <tbody>
                        <tr class="table-primary">
                            <td><input style="" type="checkbox" name="check[]" value="<?php echo $data['bid']; ?>">
                            </td>
                            <td>
                                <?php echo $data['bid']; ?>
                            </td>
                            <td>
                                <?php echo $data['username']; ?>
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

                        } ?>
                    </tbody>
                </table>



            </div>
        </div>
        <p align="center"><button class="btn btn-warning" type="submit" name="delete"
                onclick="location.reload()">Delete</button></p>
    </form>

    <?php
    }
    ?>


    <?php
    if (isset($_POST['delete'])) {
        if (isset($_POST['check'])) {
            foreach ($_POST['check'] as $delete_id) {
                mysqli_query($db, "DELETE FROM `issue_book` WHERE `bid`='$delete_id' AND `username`='{$_SESSION['login_user']}' LIMIT 1");
                ?>
    <script>
        alert("selected book has been deleted");
        window.location = "request.php";
    </script>
    <?php
            }
        }
    }
    ?>


</body>

</html>