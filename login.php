<?php
include("connection.php");
include("navbar.php");
// session_start();
?>
















<?php
if (isset($_POST['submit'])) {

    if ($_POST['user'] == 'admin') {

        $count = 0;
        $res = mysqli_query($db, "SELECT * FROM `admin` WHERE username = '$_POST[username]' AND password = '$_POST[password]' AND status='yes' ");

        $row = mysqli_fetch_assoc($res);

        $count = mysqli_num_rows($res);

        if ($count == 0) {
            ?>
            <div class="alert alert-warning position-relative h-100 d-flex align-items-center justify-content-center"
                style="background:red; color:white; ">
                <strong class="position-relative">The Username and Password doesn't match. Please Enter correct details.</strong>
            </div>
            <?php
        } else {
            // -------------------------if username and password matches------------------------

            $_SESSION['login_user'] = $_POST['username'];
            $_SESSION['pic'] = $row['pic'];
            $_SESSION['username'] = '';
            ?>
            <script>
                window.location = "admin/profile.php";
            </script>
            <?php
        }

    } else {
        $count = 0;
        $res = mysqli_query($db, "SELECT * FROM `student` WHERE username = '$_POST[username]'");

        $row = mysqli_fetch_assoc($res);

        $count = mysqli_num_rows($res);
        //------------------------------------------------------------

        if ($count > 0 && password_verify($_POST['password'], $row['password'])) {

            $_SESSION['login_user'] = $_POST['username'];
            $_SESSION['pic'] = $row['pic'];
            ?>
            <script>
                window.location = "student/profile.php";
            </script>
            <?php
            
        } else {

            echo "<script>alert('Incorrect Password');</script>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>login</title>
</head>
<style>
    .box1 {
        height: 500px;
        width: 450px;
        background-color: black;
        margin: 70px auto;
        opacity: .8;
        color: white;
        padding: 20px;
    }
    
    
        body::-webkit-scrollbar{
            display: none;
        }
</style>

<body>

    <section>
        <form method="POST" action="">
            <div class="container">
                <div class="sec_img">
                    <br>
                    <div class="box">
                        <h1 class="text-warning" style="text-align: center; font-size: 35px;">Library Management
                            System
                        </h1>
                        <h3 class="text-danger" style="text-align: center;">User Login Form</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 mx-auto">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <img width="150px" src="images/userlogin.png" alt="Alternate Text" />
                                        </center>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <hr />
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <b>
                                        <u>
                                            <p>Login as:</p>
                                        </u>

                                        <label for="admin">Admin</label>
                                        <input class="me-5" type="radio" name="user" id="admin" value="admin">
                                        <label for="student">Student</label>
                                        <input type="radio" name="user" id="student" value="student" checked><br>
                                    </b>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <label for="exampleInputEmail1">User Name</label>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="username" required
                                                placeholder="User Name">
                                        </div>
                                        <label for="exampleInputEmail1">Password</label>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" required
                                                placeholder="Password">
                                        </div>
                                        <div class="form-group mt-4">
                                            <button class="btn btn-warning btn-block btn-lg"
                                                name="submit">Login</button>
                                        </div>

                                        <!------------------ php code for signup button -------------------->
                                        <div class="form-group mt-2">
                                            <label class="ms-3 mt-2" for="">Don't have an account ? : </label>
                                            <button class="badge rounded-pill text-bg-light" name="submitr"
                                                type="submit"><a href="registration.php"
                                                    class="text-decoration-none">SIGN
                                                    UP</a></button>
                                        </div>

                                        <div class="form-group mt-2">
                                            <a href="forgotpassword.php" type="button"
                                                class="border border-0 text-decoration-none ms-3">Forget Password
                                                ?</a>
                                        </div>

                                        <br>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="mt-2">
                            <a href="index.php" class="text-decoration-none">
                                << Back to Home</a><br><br>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>







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