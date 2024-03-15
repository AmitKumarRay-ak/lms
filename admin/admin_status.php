<?php
include("connection.php");
include("navbar.php");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Status</title>
    
    <style>
        body::-webkit-scrollbar{
            display: none;
        }
    </style>
</head>

<body>

    <center>
        <h2 class="bg-danger text-white rounded-pill m-3">New Request For Admin</h2>
    </center>
    <hr>


    <h2 class="text-primary ms-5">Search By Username For Approval</h2>


    <div class="d-flex justify-content-end mt-3">
        <form action="" method="POST" class="navbar-form" name="form1">
            <div class="form-outline" data-mdb-input-init>
                <input class="rounded-pill border border-danger p-2" type="text" name="search"
                    placeholder="admin username ..." required>
                <button type="submit" name="submit" class="btn btn-default border border-success me-4">
                    <i class="fa-solid fa-magnifying-glass fa-beat" style="color: #63E6BE;"></i>
                </button>
            </div>
        </form>
    </div>


    <!-- all admin delete -->
    <form method="POST" action="">
        <h3 class="ms-5">Delete All New Registration For Admin: (Delete All in One Click)</h3>
        <button class="btn btn-danger ms-5" type="submit" name="all_admin_delete"><i
                class="fa-solid fa-trash fa-beat-fade"></i>&nbsp;
            ALL DELETE</button>
    </form>

    <?php
    if (isset($_POST['all_admin_delete'])) {
        $query = "DELETE FROM `admin` WHERE `status` != 'yes' AND `status`!='' ";
        $result = mysqli_query($db, $query);

        if ($result) {
            ?>
            <script>
                alert("Deleted Successfuly");
                window.location = "admin_status.php";
            </script>
            <?php
        }
    }
    ?>
    <!-- code end all admin delete -->


    <!------------------------------------ this div use for scrollview ---------------------------------->


    <div id="" style="overflow:scroll; height:550px;">

        <?php
        if (isset($_POST['submit'])) {
            $q = mysqli_query($db, "SELECT id,first,last,username,email,contact FROM `admin` WHERE username like '%$_POST[search]%' AND status='' ");

            if (mysqli_num_rows($q) == 0) {
                echo "<br><br><br><br><br>
                <h5 class='ms-5 text-danger'>Sorry!    New Admin Request Not Found With This Username</h5>";
            } else {
                ?>

                <div class="row m-2">
                    <div class="col m-2">
                        <table class="table table-bordered border-primary">
                            <thead>
                                <tr class="table-warning">
                                    <th scope="col">ID</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Action</th>
                                </tr>
                                <?php

                                while ($data = mysqli_fetch_array($q)) { ?>

                                </thead>
                                <tbody>
                                    <tr class="table-primary">
                                        <th scope="row">
                                            <?php echo $data['id']; ?>
                                        </th>
                                        <td>
                                            <?php echo $data['first']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['last']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['username']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $data['contact']; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-success ms-3"
                                                href="new_admin_approve_page.php?id=<?php echo $data['id']; ?>"><i
                                                    class="fa-solid fa-check fa-beat"></i>&nbsp;
                                                ACCEPT</a>
                                            <a class="btn btn-danger ms-3"
                                                href="new_admin_delete_page.php?id=<?php echo $data['id']; ?>"><i
                                                    class="fa-solid fa-trash fa-beat-fade"></i>&nbsp;
                                                DELETE</a>
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
                                <th scope="col">ID</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Username</th>
                                <th scope="col">Email</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Action</th>
                            </tr>
                            <?php
                            $sql = "SELECT id,first,last,username,email,contact FROM `admin` WHERE status='' ";
                            $result = mysqli_query($db, $sql);

                            while ($data = mysqli_fetch_array($result)) {
                                ?>
                            </thead>
                            <tbody>
                                <tr class="table-primary">
                                    <th scope="row">
                                        <?php echo $data['id']; ?>
                                    </th>
                                    <td>
                                        <?php echo $data['first']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['last']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $data['contact']; ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success ms-3"
                                            href="new_admin_approve_page.php?id=<?php echo $data['id']; ?>"><i
                                                class="fa-solid fa-check fa-beat"></i>&nbsp;
                                            ACCEPT</a>
                                        <a class="btn btn-danger ms-3"
                                            href="new_admin_delete_page.php?id=<?php echo $data['id']; ?>"><i
                                                class="fa-solid fa-trash fa-beat-fade"></i>&nbsp;
                                            DELETE</a>
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