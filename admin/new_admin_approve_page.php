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
        .tb1 {
            width: 40%;
        }

        .form-control {
            height: 30px;
        }
    </style>
</head>

<body>
    <section>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="card bg-info-subtle" style="height:800px; width:100%;">
                <div class="mt-2">

                    <div class="row m-2">
                        <div class="col">
                        </div>
                    </div>


                    <!-- ------------------------- for edit data by form -------------------------- -->
                    <?php
                    // if (isset($_POST['submit'])) {
                    
                    //     $first = $_POST['first'];
                    //     $last = $_POST['last'];
                    //     $username = $_POST['username'];
                    //     $email = $_POST['email'];
                    //     $contact = $_POST['contact'];
                    //     $status = $row['status'];
                    
                    //     $sql1 = "UPDATE `admin` SET `first`='$first',`last`='$last',`username`='$username',`email`='$email',`contact`='$contact',`status`='$status' ";
                    
                    //     if (mysqli_query($db, $sql1)) {
                    //             ?>

                    <script>
                        //             alert("Saved Successfully");
                        //             window.location="admin_status.php";
                    </script>

                    <?php
                    //     }
                    // }
                    ?>



                    <!--------------------- fetching data from database ----------------->
                    <?php
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        $query = "SELECT * FROM `admin` WHERE `id`='$id' ";
                        $result = mysqli_query($db, $query);

                        if (!$result) {
                            die("query failed" . mysqli_error($db));
                        } else {
                            $row = mysqli_fetch_assoc($result);
                            // print_r($row);
                        }
                    }
                    ?>
                    <!--------------------- Compleate fetching data from database ----------------->




                    <?php
                    if (isset($_POST['update_new_admin'])) {

                        $first = $_POST['first'];
                        $last = $_POST['last'];
                        $username = $_POST['username'];
                        $email = $_POST['email'];
                        $contact = $_POST['contact'];
                        $status = $_POST['status'];
                        
                    }
                    ?>




                    <form method="POST" action="">
                        <center>
                            <table class="table  table-info  text-wrap tb1">


                                <tr>
                                    <td><b>First Name: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="first"
                                            value="<?php echo $row['first']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Last Name: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="last"
                                            value="<?php echo $row['last']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Username: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="username"
                                            value="<?php echo $row['username']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Email: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="email"
                                            value="<?php echo $row['email']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Contact: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="contact"
                                            value="<?php echo $row['contact']; ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Status: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="contact" placeholder="Type yes"
                                            value="<?php echo $row['status']; ?>">
                                    </td>
                                </tr>
                            </table>
                            <div class="d-flex justify-content-center me-5 mt-5">
                                <button type="submit" class="btn btn-warning" style="width:100px;"
                                    name="update_new_admin"><b>Update</b></button>
                            </div>
                        </center>
                    </form>
                </div>
            </div>
        </form>
    </section>
</body>

</html>