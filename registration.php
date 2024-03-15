<?php
include("connection.php");
include("navbar.php");
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
                                        <hr />
                                    </div>
                                </div>
                                <form method="POST" name="signup" action="">
                                    <div class="form-group mb-3">
                                        <b>
                                            <u>
                                                <p>Registration as:</p>
                                            </u>

                                            <center>
                                                <label for="admin">Admin</label>
                                                <input class="me-5" type="radio" name="user" id="admin" value="admin">
                                                <label for="student">Student</label>
                                                <input type="radio" name="user" id="student" value="student"
                                                    checked><br><br><br>
                                                <button class="btn btn-warning" type="submit" name="submit1" style="width: 100px;">OK</button>
                                            </center>
                                        </b>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <?php
                        if(isset($_POST['submit1']))
                        {
                            if($_POST['user']=='admin')
                            {
                                ?>
                                <script>
                                    window.location="admin/registration.php";
                                </script>
                                <?php
                            }
                            else
                            {
                                ?>
                                <script>
                                    window.location="student/registration.php";
                                </script>
                                <?php
                            }
                        }
                        ?>

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