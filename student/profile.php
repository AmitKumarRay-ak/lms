<?php
include("connection.php");
include("navbar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        .tb1 {
            width: 50%;
        }
    </style>
</head>

<body>
    <section>
        <form method="POST" action="">
            <div class="card bg-info-subtle" style="height:100vh; width:100%;">
                <div class="mt-2">
                    <div class="d-flex justify-content-end me-5 mt-5">
                        <button type="submit" class="btn btn-primary" style="width:100px;" name="submit1">Edit</button>
                    </div>

                    <?php
                    if (isset($_POST['submit1'])) {
                        ?>
                        <script>
                            window.location = "edit.php";
                        </script>
                        <?php
                    }
                    ?>




                    <?php
                    $q = mysqli_query($db, "SELECT * FROM `student` WHERE username='$_SESSION[login_user]' ;");

                    $row = mysqli_fetch_assoc($q);
                    ?>

                    <div class="row m-2">
                        <div class="col">
                            <center>
                                <?php
                                echo "<img width='150px' height='150px' class='rounded-circle ' src='images/" . $_SESSION['pic'] . "' alt='Alternate Text' />";
                                ?>
                                <div class="box mt-1">
                                    <h3 class="badge rounded-pill text-bg-warning" style="text-align: center;">
                                        MY
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
                        <table class="table table-bordered border-danger table-info  text-wrap tb1">
                            <tr>
                                <td><b>First Name: </b></td>
                                <td>
                                    <?php echo " " . $row['first']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Last Name: </b></td>
                                <td>
                                    <?php echo " " . $row['last']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Username: </b></td>
                                <td>
                                    <?php echo " " . $row['username']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Password: </b></td>
                                <td>
                                    <?php echo " " . $row['password']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Roll: </b></td>
                                <td>
                                    <?php echo " " . $row['roll']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Email: </b></td>
                                <td>
                                    <?php echo " " . $row['email']; ?>
                                </td>
                            </tr>

                            <tr>
                                <td><b>Contact: </b></td>
                                <td>
                                    <?php echo " " . $row['contact']; ?>
                                </td>
                            </tr>
                        </table>
                    </center>
                </div>
            </div>
        </form>
    </section>
</body>

</html>