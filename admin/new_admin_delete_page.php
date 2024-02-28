<?php
include("connection.php");
include("navbar.php");
?>

<?php

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM `admin` WHERE `id` = '$id' ";
    $result = mysqli_query($db, $query);

    if (!$result) {
        die("Queary Failed" . mysqli_error($db));
    } else {
        ?>
        <script>
            alert("Deleted Successfuly");
            window.location = "admin_status.php";
        </script>
        <?php
    }
}
?>