<?php
include("connection.php");
include("navbar.php");
// session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>
<body>
    <?php
if (isset($_GET['email']) && isset($_GET['reset_token'])) {
    date_default_timezone_set('Asia/Kolkata'); // Corrected timezone spelling
    $date = date("Y-m-d"); // Corrected date assignment
    $query = "SELECT * FROM `student` WHERE `email`='$_GET[email]' AND `resettoken`='$_GET[reset_token]' AND `resettokenexpire`='$date' ";
    $result = mysqli_query($db, $query);

    if ($result) {

        if (mysqli_num_rows($result) == 1) {
            // form
            ?>
            <section>
                <div class="container">
                    <div class="sec_img">
                        <br>
                        <div class="box">
                            <h3 class="text-danger" style="text-align: center;">Enter New Password</h3>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6 mx-auto">
                            <div class="card bg-primary-subtle">
                                <div class="card-body">

                                    <br><br>
                                    <form method="POST" action="">
                                        <div class="row">
                                            <div class="col">
                                                <label for="exampleInputEmail1">New Password</label>
                                                <div class="form-group">
                                                    <input type="password" class="form-control mt-1" name="password"
                                                        placeholder="Enter New Password">
                                                </div>
                                                <div class="form-group mt-4">
                                                    <button type="submit" class="btn btn-warning btn-block"
                                                        name="updatepassword">UPDATE</button>
                                                </div>
                                                <input type="hidden" class="form-control mt-1" name="email"
                                                    value="<?php echo $_GET['email'] ?>">
                                                <br><br>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- php code -->

                                    <!-- for password submit -->
                                    <?php
                                    if (isset($_POST['updatepassword'])) {
                                        $pass = password_hash($_POST['password'],PASSWORD_BCRYPT);
                                        $query = "UPDATE `student` SET `password`='$pass',`resettoken`=NULL,`resettokenexpire`=NULL WHERE `email`='$_POST[email]' ";

                                        if (mysqli_query($db, $query)) {
                                            echo "
                                            <script>
                                            alert('Password Updated Successfully');
                                            window.location.href='index.php';
                                            </script>
                                            ";
                                        } else {
                                            echo "
                                            <script>
                                            alert('Server down! try again later');
                                            window.location.href='index.php';
                                            </script>
                                            ";
                                        }
                                    }
                                    ?>

                                    <!-- End php code -->
                                </div>
                            </div>

                            <div class="mt-2">
                                <a href="index.php" class="text-decoration-none">
                                    << Back to Home</a><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php
            // end form
        } else {
            ?>
            <script>
                alert('Link Expired');
            </script>
            <?php
        }

    } else {
        echo "
                <script>
                alert('Server down! try again later');
                window.location.href='index.php';
                </script>
                ";
    }
}
?>
</body>
</html>


