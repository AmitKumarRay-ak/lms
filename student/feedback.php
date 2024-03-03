<?php
include("connection.php");
include("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="student_style.css">

</head>

<body>


    <section>
        <div class="container bg-light">
            <div class="row">
                <div class="col-md-8 mx-auto text-danger">
                    <p>If you have any suggesions or questions please comment below.</p>
                    <br><br><br>
                    <form action="" method="POST">
                        <input class="form-control mt-1" type="text" name="comment" placeholder="Write Something .... ">
                        <input class="btn btn-primary mt-3" type="submit" name="submit" value="Comment">
                    </form>


                    <br><br>
                    <hr>
                    <h1 class="display-6 text-warning">All Comments</h1>

                    <div id="getdata" style="overflow:scroll; height:300px;">
                        <?php
                        if (isset($_POST['submit'])) {
                            $sql = "INSERT INTO `comments`(`username`,`comment`) VALUES ('$_SESSION[login_user]','$_POST[comment]')";
                            if (mysqli_query($db, $sql)) {
                                $q = "SELECT * FROM `comments` ORDER BY id DESC";
                                $res = mysqli_query($db, $q);

                                echo "<table class='table table-bordered'>";
                                while ($row = mysqli_fetch_assoc($res)) {
                                    echo "<tr>";

                                    echo "<td style='width:40%;'>";
                                    echo $row['username'];
                                    echo "</td>";

                                    echo "<td>";
                                    echo $row['comment'];
                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            }
                        } else {
                            $q = "SELECT * FROM `comments` ORDER BY id DESC";
                            $res = mysqli_query($db, $q);

                            echo "<table class='table table-bordered'>";
                            while ($row = mysqli_fetch_assoc($res)) {
                                echo "<tr>";

                                echo "<td style='width:40%;'>";
                                echo $row['username'];
                                echo "</td>";

                                echo "<td>";
                                echo $row['comment'];
                                echo "</td>";

                                echo "</tr>";
                            }
                            echo "</table>";
                        }
                        ?>


                    </div>
                </div>
            </div>
            <br>
        </div>
    </section>








    <script>
        function dis() {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "FetchFeedbackMessage.php", false);
            xmlhttp.send(null);
            document.getElementById("getdata").innerHTML = xmlhttp.responseText;
        }

        dis();

        setInterval(function () {
            dis();
        }, 2000)
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>
</body>

</html>