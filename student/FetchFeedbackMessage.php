<?php
// $db = mysqli_connect("localhost", "root", "", "library");
include("connection.php");



$res = mysqli_query($db, "SELECT * FROM `comments` ORDER BY id DESC");

// while ($row = mysqli_fetch_assoc($res)) {
//     echo $row["username"] . " " . $row["comment"];
//     echo "<br>";
// }


echo "<table class='table table-bordered'>";
while ($row = mysqli_fetch_assoc($res)) {
    echo "<tr>";

    echo "<td style='width:30%;'>";
    echo $row['username'];
    echo "</td>";

    echo "<td>";
    echo $row['comment'];
    echo "</td>";

    echo "</tr>";
}
echo "</table>";
?>