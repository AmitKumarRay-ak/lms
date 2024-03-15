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



    <!------------------------------------ this div use for scrollview ---------------------------------->


    <div id="" style="overflow:scroll; height:550px;">

        <div class="row m-2">
            <div class="col m-2">
                <table class="table table-bordered border-primary">
                    <thead>
                        <tr class="table-warning">
                            <th scope="col">Username</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Rturned</th>
                            <th scope="col">Day</th>
                            <th scope="col">Fine in Rs.</th>
                            <th scope="col">Status</th>
                        </tr>
                        <?php
                        $sql = "SELECT * FROM `fine` where username='$_SESSION[login_user]' ";
                        $result = mysqli_query($db, $sql);

                        while ($data = mysqli_fetch_array($result)) { ?>

                        </thead>
                        <tbody>
                            <tr class="table-primary">
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
                            </tr>

                            <?php

                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php

        ?>
    </div>


</body>

</html>