<?php
include("connection.php");
include("navbar.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fine Calculation</title>
    
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
            $q = mysqli_query($db, "SELECT * FROM `fine` WHERE username like '%$_POST[search]%' ");

            if (mysqli_num_rows($q) == 0) {
                echo "<h3 class='text-primary' style='margin:10px; padding:200px;'>";
                echo "Sorry!  student not found with this username ";
                echo "<h3>";
            } else {
                ?>

                <div class="row m-2">
                    <div class="col m-2">
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr class="table-warning">
                                    <th scope="col">Sl no.</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Bid</th>
                                    <th scope="col">Returned</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Fine in Rs.</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Payment</th>
                                </tr>
                                <?php

                                while ($data = mysqli_fetch_array($q)) { ?>

                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <td>
                                            <?php echo $data['id']; ?>
                                        </td>
                                        <th scope="row">
                                            <?php echo $data['username']; ?>
                                        </th>
                                        <td>
                                            <?php echo $data['bid']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['returned']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['day']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['fine']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['status']; ?>
                                        </td>
                                        <form action="" method="POST">
                                            <td class="">
                                                <a href="fine_paid_and_unpaid_update.php?id=<?php echo $data['id']; ?>"
                                                    type="submit" name="submit4" class="btn btn-success">Update</a>
                                            </td>
                                        </form>
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
                                <th scope="col">Sl no.</th>
                                <th scope="col">Username</th>
                                <th scope="col">Bid</th>
                                <th scope="col">Returned</th>
                                <th scope="col">Day</th>
                                <th scope="col">Fine in Rs.</th>
                                <th scope="col">Status</th>
                                <th scope="col">Payment</th>
                            </tr>
                            <?php
                            $sql = "SELECT * FROM `fine`";
                            $result = mysqli_query($db, $sql);

                            while ($data = mysqli_fetch_array($result)) { ?>

                            </thead>
                            <tbody>
                                <tr class="table-primary">
                                    <td>
                                        <?php echo $data['id']; ?>
                                    </td>
                                    <th scope="row">
                                        <?php echo $data['username']; ?>
                                    </th>
                                    <td>
                                        <?php echo $data['bid']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['returned']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['day']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['fine']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['status']; ?>
                                    </td>
                                    <form action="" method="POST">
                                        <td class="">
                                            <a href="fine_paid_and_unpaid_update.php?id=<?php echo $data['id']; ?>"
                                                type="submit" name="submit4" class="btn btn-success">Update</a>
                                        </td>
                                    </form>
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