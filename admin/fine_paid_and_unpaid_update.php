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
            width: 50%;
            border-radius: 25px;
        }

        .form-control {
            height: 30px;
        }

        .card {
            justify-content: center;
            align-items: center;
        }

        .row {
            justify-content: center;
            align-items: center;
            background-color: #3498eb;
            width: 800px;
            height: 600px;
            border-radius: 25px;
        }

        .col {
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>

    <!------------------------------------------------ php code for fetching data in form ------------------------------------------->
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $query = "SELECT * FROM `fine` WHERE `id`='$id' ";
        $result = mysqli_query($db, $query);
        $row = mysqli_fetch_assoc($result);

        if ($row) {

        } else {
            echo "not data found";
        }
    }
    ?>
    <!-------------------------------------------- End php code for fetching data in form ------------------------------------------->





    <!------------------------------------------------ php code for update data in form ------------------------------------------->
    <?php
    if (isset($_POST['submit'])) {

        if(isset($_GET['id_new']))
        {
            $idnew = $_GET['id_new'];
        }

        $username = $_POST['username'];
        $bid = $_POST['bid'];
        $returned = $_POST['returned'];
        $day = $_POST['day'];
        $fine = $_POST['fine'];
        $status = $_POST['status'];


        $query1 = "UPDATE `fine` SET `username`='$username',`bid`='$bid',`returned`='$returned',`day`='$day',`fine`='$fine',`status`='$status' WHERE `id`='$idnew'";
        $result1 = mysqli_query($db, $query1);

        if ($result1) {
            ?>
            <script>
                window.location="fine.php";
            </script>
            <?php
        } else {
            echo "Error";
        }
    }
    ?>
    <!------------------------------------------------ php code for update data in form ------------------------------------------->

    <section>

        <form method="POST" action="fine_paid_and_unpaid_update.php?id_new=<?php echo $id ?>">
            <div class="card" style="height:100vh; width:100%;">
                <div class="mt-2">
                    <div class="row">
                        <div class="col">
                            <div class="text-wrap tb1">

                                <tr>
                                    <td><b>Username: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="username" readonly
                                            value="<?php echo $row['username'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Bid: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="bid" readonly
                                            value="<?php echo $row['bid'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Returned: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="returned" readonly
                                            value="<?php echo $row['returned'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Day: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="day" readonly
                                            value="<?php echo $row['day'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Fine in Rs.: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="fine" readonly
                                            value="<?php echo $row['fine'] ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Status: </b></td>
                                    <td>
                                        <input class="form-control" type="text" name="status"
                                            value="<?php echo $row['status'] ?>" placeholder="paid / not paid">
                                    </td>
                                </tr>
                                <div class="d-flex justify-content-center me-5 mt-5">
                                    <button type="submit" class="btn btn-warning" style="width:100px;"
                                        name="submit"><b>Update</b></button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</body>

</html>