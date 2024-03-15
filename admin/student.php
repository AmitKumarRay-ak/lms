<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>

    <center>
        <h2>List of Students</h2>
    </center>
    <hr>


    <div class="d-flex justify-content-end mt-3">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border border-danger p-2" type="text" name="search"
                    placeholder="student username ..." required>
                <button type="submit" name="submit" class="btn btn-default border border-success me-4">
                    <i class="fa-solid fa-magnifying-glass fa-beat" style="color: #63E6BE;"></i>
                </button>
            </div>
        </form>
    </div>



    <!------------------------------------ this div use for scrollview ---------------------------------->


    <div id="" style="overflow:scroll; height:550px;">

        <?php
        if (isset($_POST['submit'])) {
            $q = mysqli_query($db, "SELECT first,last,username,roll,email,contact FROM `student` WHERE username like '%$_POST[search]%' ");

            if (mysqli_num_rows($q) == 0) {
                echo "Sorry!  student not found with this username ";
            } else {
                ?>

                <div class="row m-2">
                    <div class="col m-2">
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr class="table-warning">
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Roll</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                </tr>
                                <?php

                                while ($data = mysqli_fetch_array($q)) { ?>

                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th scope="row">
                                            <?php echo $data['first']; ?>
                                        </th>
                                        <td>
                                            <?php echo $data['last']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['username']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['roll']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['contact']; ?>
                                        </td>
                                    </tr>

                                    <?php

                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <?php
            }
        } else {
            ?>

            <div class="row m-2">
                <div class="col m-2">
                    <table class="table table-bordered border-primary">
                        <thead>
                            <tr class="table-warning">
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Username</th>
                                <th scope="col">Roll</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                            </tr>
                            <?php
                            $sql = "SELECT first,last,username,roll,email,contact FROM `student` ORDER BY `first` ASC";
                            $result = mysqli_query($db, $sql);

                            while ($data = mysqli_fetch_array($result)) { ?>

                            </thead>
                            <tbody>
                                <tr class="table-primary">
                                    <th scope="row">
                                        <?php echo $data['first']; ?>
                                    </th>
                                    <td>
                                        <?php echo $data['last']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['roll']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['contact']; ?>
                                    </td>
                                </tr>

                                <?php

                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
        }
        ?>
    </div>


</body>

</html>