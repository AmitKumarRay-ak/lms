<?php
include("connection.php");
include("navbar.php");
?>

<!-- php code for signup -->

<?php

if (isset($_POST['submit'])) {
    $user_exist_quary = "SELECT * FROM `student` WHERE `username`='$_POST[username]' OR `email`='$_POST[email]' ";
    $result = mysqli_query($db, $user_exist_quary);

    if ($result) {

        if (mysqli_num_rows($result) > 0) {  // it will be excuted if username or email is already taken

            $result_fetch = mysqli_fetch_assoc($result);

            // User has allready taken username or email
            if ($result_fetch['username'] == $_POST['username']) {

                // error for username allready resister
                echo "
                    <script>
                    alert('$result_fetch[username] - User Has Allready Taken Username');
                    window.location='../login.php';
                    </script>
                    ";
            } else {

                // error for username allready resister
                echo "
                    <script>
                    alert('$result_fetch[email] - Email Allready Register');
                    window.location='../login.php';
                    </script>
                    ";
            }

        } else {  // it is excute when no one has taken username or email before

            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $query = "INSERT INTO `student`(`first`, `last`, `username`, `password`, `roll`, `email`, `contact`, `pic`) VALUES ('$_POST[first]','$_POST[last]','$_POST[username]','$password','$_POST[roll]','$_POST[email]','$_POST[contact]','p.png')";
            if (mysqli_query($db, $query)) {

                // if data inserted successfully
                echo "
                <script>
                alert('Resistration Successfull');
                window.location='../login.php';
                </script>
                ";
            } else {

                // if data cannot be inserted
                echo "
                <script>
                alert('Cannot Run Query');
                window.location='../login.php';
                </script>
                ";
            }
        }

    } else {
        echo "
        <script>
        alert('Cannot Run Query');
        window.location='../login.php';
        </script>
        ";
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

    <title>Registration</title>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>




    <section>
        <form method="POST" action="">
            <div class="container">
                <div class="sec_img">
                    <br>
                    <div class="box">
                        <h1 class="text-warning" style="text-align: center; font-size: 35px;">Library Management System
                        </h1>
                        <h3 class="text-danger" style="text-align: center;">Registration Form</h3>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 mx-auto">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <img width="150px" src="images/sign-up.png" alt="Alternate Text" />
                                        </center>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <center>
                                            <h3>Student</h3>
                                        </center>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <hr />
                                    </div>
                                </div>


                                <form name="registration" action="" method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <label for="exampleInputEmail1">First Name</label> Name</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="first" required
                                                    placeholder="First Name">
                                            </div>

                                            <label for="exampleInputEmail1">Last Name</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="last" required
                                                    placeholder="Last Name">
                                            </div>

                                            <label for="exampleInputEmail1">User Name</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="username" required
                                                    placeholder="User Name">
                                            </div>

                                            <label for="exampleInputEmail1">Password</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="password" required
                                                    placeholder="Password">
                                            </div>

                                            <label for="exampleInputEmail1">Roll No.</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="roll" required
                                                    placeholder="Roll No.">
                                            </div>

                                            <label for="exampleInputEmail1">Email</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" required
                                                    placeholder="Email">
                                            </div>

                                            <label for="exampleInputEmail1">Mobile No.</label>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="contact" required
                                                    placeholder="MOBILE NO.">
                                            </div>

                                            <div class="form-group mt-4">
                                                <button class="btn btn-success btn-block btn-lg" name="submit">Sign
                                                    up</button>
                                            </div>
                                            <div class="form-group mt-2">
                                                <label class="ms-3 mt-2" for="">Allready have an account : </label>
                                                <button class="badge rounded-pill text-bg-light"><a href="../login.php"
                                                        class="text-decoration-none">Login</a></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>

                        <div class="mt-2">
                            <a href="../index.php" class="text-decoration-none">
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