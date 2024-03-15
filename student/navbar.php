<?php
include("connection.php");
error_reporting(E_ERROR | E_PARSE);
session_start();
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>

    <?php
    // $r = mysqli_query($db, "SELECT COUNT(status) as total FROM message WHERE status='no' and username='$_SESSION[login_user]' and sender='admin' ;");
    // $c = mysqli_fetch_assoc($r);
    
    ?>




    <nav class="navbar navbar-expand-lg bg-info-subtle">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="images/books.png" alt="Alternate Text" width="40" height="40" />
                E-Library
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0" style="align-items: right;">
                    <li class="btn nav-item"><a class="text-decoration-none" href="index.php">HOME</a></li>
                    <li class="btn nav-item"><a class="text-decoration-none" href="books.php">BOOKS</a></li>
                    <li class="btn nav-item"><a class="text-decoration-none" href="feedback.php">FEEDBACK</a></li>
                    <li class="btn nav-item"><a class="text-decoration-none" href="fine.php">FINES</a></li>
                </ul>

                <?php
                if (isset($_SESSION['login_user'])) {
                    ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 mt-2" style="align-items: right;">

                        <!------------------------ message icon ---------------------->
                        <!-- <li class="btn border-0 nav-item"><a class="text-decoration-none" href="message_from_librarian.php">
                                <i class="fa-regular fa-bell"></i>
                                <span class="badge rounded-pill text-bg-info">
                                    
                                </span>
                            </a>
                        </li> -->
                        <!------------------------End message icon ---------------------->

                        <li class="btn nav-item">
                            <a class="text-decoration-none" href="profile.php">
                                <?php
                                echo "<img class='rounded-circle profile_img' style='height:30px; width:30px;' src='images/" . $_SESSION['pic'] . " '>";
                                echo " " . $_SESSION['login_user'];
                                ?>
                            </a>
                        </li>
                        <li class="btn nav-item"><a class="badge rounded-pill text-bg-danger text-decoration-none"
                                href="profile.php">PROFILE</a></li>
                        <li class="btn nav-item"><a class="text-decoration-none" href="logout.php"><i
                                    class="fa-solid fa-right-from-bracket"></i> LOGOUT</a></li>
                    </ul>
                    <?php
                } else {
                    ?>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0" style="align-items: right;">
                        <li class="btn nav-item"><a class="text-decoration-none" href="../login.php"><i
                                    class="fa-solid fa-right-to-bracket"></i> LOGIN</a></li>
                        <li class="btn nav-item"><a class="text-decoration-none" href="registration.php"><i
                                    class="fa-solid fa-user-plus"></i> SIGN UP </a></li>
                    </ul>
                    <?php
                }
                ?>
            </div>
        </div>
    </nav>






    <?php
    if (isset($_SESSION['login_user'])) {

        $day = 0;
        $exp = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
        $res = mysqli_query($db, "SELECT * FROM `issue_book` WHERE username='$_SESSION[login_user]' and approv='$exp' ");

        while ($row = mysqli_fetch_assoc($res)) {
            $d = strtotime($row['return']);
            $c = strtotime(date("Y-m-d"));

            $diff = $c - $d;

            if ($diff >= 0) {
                $day = $day + floor($diff / (60 * 60 * 24));
                // echo $day;
            }
        }
        $_SESSION['fine'] = $day * 20;
        // echo $day;
    
    }
    ?>
















    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>