<?php
include("connection.php");
include("navbar.php");
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile edit</title>
    <style>
    
        body::-webkit-scrollbar{
            display: none;
        }
    
        .tb1 {
            width: 40%;
        }

        .form-control {
            height: 30px;
        }

        @media (min-width: 400px) and (max-width: 1080px) {

            .table{
                width: 90%;
            }
        }
    </style>
</head>

<body>
    <section>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="card bg-info-subtle card1" style="height:800px; width:100%;">
                <div class="mt-2">

                    <?php

                    $q = mysqli_query($db, "SELECT * FROM `admin` WHERE username='$_SESSION[login_user]' ;");

                    $row = mysqli_fetch_assoc($q);
                    ?>

                    <div class="row m-2">
                        <div class="col">
                            <center>
                                <?php
                                echo "<img width='150px' height='150px' class='rounded-circle' src='images/" . $_SESSION['pic'] . "' alt='Alternate Text' />";
                                ?>
                                <div class="box mt-1">
                                    <h3 class="badge rounded-pill text-bg-warning" style="text-align: center;">MY
                                        PROFILE</h3>
                                </div>
                            </center>
                        </div>
                    </div>
                    <div class="box mt-1">
                        <b>

                            <h4 style="text-align:center;">
                                <span class="badge rounded-pill text-bg-success" style="text-align: center;">Welcome
                                    :</span>
                                <?php
                                echo $_SESSION['login_user'];
                                ?>
                            </h4>
                        </b>
                    </div>





                    <center>
                        <?Php
                        //------------------------- for fetching data from database --------------------------
                        $sql = "SELECT * FROM `student` WHERE username='$_SESSION[login_user]'";
                        $result = mysqli_query($db, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            $first = $row['first'];
                            $last = $row['last'];
                            $username = $row['username'];
                            $password = $row['password'];
                            $email = $row['email'];
                            $contact = $row['contact'];
                        }
                        ?>


                        <!-- ------------------------- for edit data by form -------------------------- -->
                        <?php
                        if (isset($_POST['submit'])) {

                            move_uploaded_file($_FILES['file']['tmp_name'], "images/" . $_FILES['file']['name']);

                            $first = $_POST['first'];
                            $last = $_POST['last'];
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            $email = $_POST['email'];
                            $contact = $_POST['contact'];
                            $pic = $_FILES['file']['name'];

                            $sql1 = "UPDATE `student` SET `pic`='$pic',`first`='$first',`last`='$last',`username`='$username',`password`='$password',`email`='$email',`contact`='$contact' WHERE username='" . $_SESSION['login_user'] . "' ";

                            if (mysqli_query($db, $sql1)) {
                                ?>
                                <script>
                                    alert("Saved Successfully");
                                    window.location = "profile.php";
                                </script>
                                <?php
                            }
                        }
                        ?>
                        <table class="table  table-info  text-wrap tb1">

                            <tr>
                                <td><b>Profile Image: </b></td>
                                <td>
                                    <input class="form-control" type="file" name="file" value="">
                                </td>
                            </tr>

                            <tr>
                                <td><b>First Name: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="first" value="<?php echo $first; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td><b>Last Name: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="last" value="<?php echo $last; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td><b>Username: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="username"
                                        value="<?php echo $username; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td><b>Password: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="password"
                                        value="<?php echo $password; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td><b>Email: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
                                </td>
                            </tr>

                            <tr>
                                <td><b>Contact: </b></td>
                                <td>
                                    <input class="form-control" type="text" name="contact"
                                        value="<?php echo $contact; ?>">
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-center me-5 mt-5">
                            <button type="submit" class="btn btn-warning" style="width:100px;"
                                name="submit"><b>Update</b></button>
                        </div>
                    </center>
                </div>
            </div>
        </form>
    </section>
</body>

</html>