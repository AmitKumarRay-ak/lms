<?php
include("connection.php");
include("navbar.php");
?>




<?php
if (isset($_POST['submit'])) {
    if (isset($_SESSION['login_user'])) {
        // Check if file was uploaded without errors
        if (isset($_FILES['bookimage']) && $_FILES['bookimage']['error'] === UPLOAD_ERR_OK) {
            // Check enctype attribute
            $target_dir = "book_image/";
            $target_file = $target_dir . basename($_FILES['bookimage']['name']);

            // Move the uploaded file to the desired location
            if (move_uploaded_file($_FILES['bookimage']['tmp_name'], $target_file)) {
                // Check if the book already exists
                $query = mysqli_query($db, "SELECT * FROM `books` WHERE `bid` = '$_POST[bid]'");
                if (mysqli_num_rows($query) > 0) {
                    // Book already exists
                    ?>
                    <script>
                        alert("Book with the same ID already exists.");
                    </script>
                    <?php
                } else {
                    // Insert the book details into the database
                    mysqli_query($db, "INSERT INTO `books` (`bid`, `bimage`, `name`, `authors`, `edition`, `status`, `quantity`, `department`,`price`) VALUES ('$_POST[bid]','$target_file','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]','$_POST[price]')");
                    ?>
                    <script>
                        alert("Book Added Successfully");
                    </script>
                    <?php
                }
            } else {
                echo "Failed to move uploaded file.";
            }
        } else {
            echo "No file uploaded or an error occurred during upload.";
        }
    } else {
        ?>
        <script>
            alert("You Need To Login First");
        </script>
        <?php
    }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            /* font-family: "Lato", sans-serif; */
            font-family: "Comic Sans MS", cursive;
        }

        .sidenav {
            height: 100%;
            margin-top: 60px;
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


        /* form css */
        .container {
            width: 100%;
            max-width: 400px;
        }

        .card {
            width: 100%;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        input {
            padding: 3px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
            outline: none;
            color: #333;
        }

        input:focus {
            border-color: #ff4500;
        }

        button {
            background-color: #ff4500;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        button:hover {
            background-color: #e63900;
        }

        /* form css end */

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body class="bg-warning-subtle">
    <!---------------------------------------------- sidenav start ----------------------------------------->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <!-- <div class="side_nav_button"> -->
        <a class="text-decoration-none text-warning" style="font-size: 17px;" href="profile.php">
            <!-- </div> -->
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
        <div class="side_nav_button"><a href="profile.php">Profile</a></div>
        <div class="side_nav_button"><a href="add.php">Add Book</a></div>
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

    <h4 class="text"></h4>

    <form class="" action="add.php" method="POST" enctype="multipart/form-data">
        <h2>Add New Books</h2>
        <div class="container">
            <div class="card bg-warning-subtle">

                <input class="rounded-pill ps-3" type="text" id="" name="bid" placeholder="SL No." required><br>
                <input class="rounded-pill bg-light custom-file-input ps-3" type="file" id="customFile" name="bookimage"
                    placeholder="Book image" required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="name" placeholder="Book Name" required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="authors" placeholder="Book Author"
                    required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="edition" placeholder="Edition" required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="status" placeholder="Status" required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="quantity" placeholder="Book Quantity"
                    required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="department" placeholder="Book Department"
                    required><br>
                <input class="rounded-pill ps-3" type="text" id="" name="price" placeholder="Price" required><br>
                <button class="rounded-pill" name="submit" type="submit">ADD</button>
            </div>
        </div>
    </form>






</body>

</html>